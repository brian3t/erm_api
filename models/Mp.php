<?php
namespace app\models;
define("TRACKING_PUSH_DAYS_BACK", 30);
// define("DEBUGGING")

use Faker\Provider\DateTime;
use yii;
use \app\models\base\Mp as BaseMp;

/**
 * Marketplace.
 * e.g. 2 / Loehmann's / loehmanns
 * How to create a marketplace:
 * - Browse <site_url>/mp/create
 * - Create folder data/[end_point_name]
 * - Create folder data/[end_point_name]/orders
 * - Create file config/mp/[end_point_name].json
 * In the future, this will be done automatically
 *
 */
class Mp extends BaseMp
{
//  Uncomment this for apigen to work
    /** @var  stdClass $config */
    public $config = MpConfig::class;
    public $curl_options;
    var $args;
    
    /**
     * @inheritdoc
     * Mp overriding ActiveQuery findOne.
     * If a marketplace is found, we start pulling its config from json file.
     * Json file is located at ../config/mp/[mp's end_point_name].json
     *
     */
    public static function findOne($condition)
    {
        $instance = parent::findOne($condition);
        
        if (!$instance) {
            return 0;
        }
        /** @var $instance \app\models\Mp */
        
        $json_file_path = Yii::getAlias('@app') . DIRECTORY_SEPARATOR . "config" . DIRECTORY_SEPARATOR . "mp" . DIRECTORY_SEPARATOR . "$instance->end_point_name.json";
        if (!file_exists($json_file_path)) {
            Yii::error("Config file not found at $json_file_path.");
            return -1;
        }
        $json_file = file_get_contents($json_file_path);
        try {
            $instance->config = json_decode($json_file);
            
        } catch (yii\base\Exception $e) {
            Yii::error($e);
        }
        return $instance;
    }
    
    /**
     * @param array $row Csv array, e.g. //Order #,Ship To Name,Ship To Address 1,Ship To Address 2,Ship To City,Ship To State,Ship To Zip,Ship Method,Product ID,Sold For,Our Cost,Qty,Description,Shipping Cost,Order Source
     * @param string $order_date_time
     * @return mixed Order id if successful. Error message if failed.
     *
     * Order //    mp_id, channel_refnum, rop_order_id, last_mp_updated, last_rop_pull, count_rop_pull, order_date_time,  name,  company,  email,  address,  address2,  city,  state,  zip,  country,  phone,  ship_name,  ship_company,  ship_address,  ship_address2,  ship_city,  ship_state,  ship_zip,  ship_country,  ship_phone,  pay_type,  pay_transaction_id,  comments,  product_total,  tax_total,  shipping_total,  grand_total,  shipping,  discount,  status`
     * Order_item: SELECT  order_id    , sku    , product    , price_per_unit    , quantity    , status    , last_mp_updated    , mp_item_id
     */
    protected function insert_order_from_csv($row = null, $order_date_time)
    {
        $order_item = new OrderItem();
        if (empty($order_date_time)) {
            $order_date_time = date('Y-m-d h:i:s');
        }
        $existing_mp_order = Order::findOne(['mp_id' => $this->id, 'channel_refnum' => $row[$this->config->MP_REF_NUM_COL]]);
        if (!is_object($existing_mp_order)) {
            $order = new Order(['mp_id' => $this->id]);
        } else {
            $order = $existing_mp_order;
        }
        $order_note = [];
        foreach ($this->config->order_columns as $index => $column) {
            if (strpos($column, 'order_item.') !== false) {
                $column = str_replace('order_item.', '', $column);
                $order_item->$column = $row[$index];
            } elseif (strpos($column, 'note.') !== false) {
                $column_name = substr($column, 5);
                if ($row[$index] !== "N/A") {
                    $order_note[$column_name] = $row[$index];
                }
            } else {
                $order->$column = $row[$index];
            }
        }
        
        $order->note = json_encode($order_note);
        $order->order_date_time = $order_date_time;
        $order->last_mp_updated = new yii\db\Expression('NOW()');//todob debug why this is PST timezone. It should be UTC
        
        
        if (!is_object($existing_mp_order)) {
            if (!$order->save()) {
                Yii::error("Failed to save order: " . $order->channel_refnum);
                return "Failed to save order: " . $order->channel_refnum . PHP_EOL;
            };
        } //else we don't need to save order
        
        $order_item->order_id = $order->id;
        if (!$order_item->save()) {
            Yii::error("Failed to save order item" . $order_item->product);
            return "Failed to save order item" . $order_item->product . $order_item->getErrors() . PHP_EOL;
        }
        
        return $order->id;
    }
    
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return array_replace_recursive(parent::rules(),
            [
                [['id'], 'required'],
                [['id'], 'integer'],
                [['name', 'end_point_name'], 'string', 'max' => 45]
            ]);
    }
    
    
    /**
     * Pull latest data from FTP, store in data/ folder
     * (only new files will be downloaded)
     * Compare with existing files to see what new files have just been downloaded
     * Import into inventory_mp database
     * Archive
     * Logs event
     *
     * @param integer $day_offset Days ago. Giving 2 will import orders two days ago
     * @return string Messages.
     */
    public function order_import_ftp($day_offset = 0)
    {
        $message = "";
        if (empty($this->config->ftp->host)) {
            $message .= "Failed";
            return $message;
        };
        
        // set up basic connection
        $conn_id = ftp_connect($this->config->ftp->host);
        
        // login with username and password
        $login_result = ftp_login($conn_id, $this->config->ftp->username, $this->config->ftp->password);
        if (!$login_result) {
            return $message . " Can not login to ftp\n";
        }
        ftp_pasv($conn_id, true);
        ftp_chdir($conn_id, $this->config->ftp->folder);
        
        $date = new \DateTime();
        $date->sub(new \DateInterval("P" . $day_offset . "D"));//backdating
        // try to DOWNLOAD $server_file and save to $local_file
        try {
            // get file list of current directory
            $file_list = ftp_nlist($conn_id, ".");
            if (!$file_list) {
                return $message . " No file found in ftp folder. Exiting.. \n";
            }
            $server_files_today = array_filter($file_list, function ($v) use ($date) {
                return preg_match("$" . $this->config->ORDER_FILE_NAME_PRE . '-' . $date->format('mdy') . "-\d{6}\.csv$", $v);//filename to match: SHOEMETRO-ORDER-010116-224502.csv
            });
            
            //compare with local files. Also include archive folder
            chdir(Yii::getAlias('@app') . DIRECTORY_SEPARATOR . "data" . DIRECTORY_SEPARATOR . $this->end_point_name . DIRECTORY_SEPARATOR . "orders" . DIRECTORY_SEPARATOR);//var/www/sme/data/loehmanns/orders
            
            $local_files = array_merge(scandir("."), scandir("archive"));
            
            $local_files_today = array_filter($local_files, function ($v) use ($date) {
                return preg_match("$" . $this->config->ORDER_FILE_NAME_PRE . '-' . $date->format('mdy') . "-\d{6}\.csv$", $v);//filename to match: SHOEMETRO-ORDER-010116-224502.csv
            });
            $server_files_today = array_diff($server_files_today, $local_files_today);
            foreach ($server_files_today as $file_name) {
                $message .= "Downloading $file_name..." . (ftp_get($conn_id, $file_name, $file_name, FTP_BINARY) ? " succeeded." : " failed!.");
            }
        } catch (yii\base\Exception $e) {
            echo "There was a problem browsing FTP site\n";
        }
        
        // close the connection
        ftp_close($conn_id);
        
        if (empty($server_files_today)) {
            return $message;
        }
        
        $message .= PHP_EOL;
        //Import
        //debug:
//        $i = 0;
//        $MAX = 1;
        foreach ($server_files_today as $file_name) {
            preg_match('/^.*-(\d{6}).csv/', $file_name, $order_time);
            if (!isset($order_time[1])) {
                $message .= "No order time matched. Assume current time";
                $order_date_time = $date->format('Y-m-d h:i:s');
            } else {
                $order_time = $order_time[1];//210805
                $order_time = substr($order_time, 0, 2) . ":" . substr($order_time, 2, 2) . ':' . substr($order_time, 4, 2);
                $order_date_time = $date->format('Y-m-d ') . $order_time;
            }

//            if($i++ > $MAX)
//            {
//                break;
//            }
            $file = fopen($file_name, "r");
            fgetcsv($file, null, ","); // skip header
            $row = 0;
            $has_error = false;
            while (($data = fgetcsv($file, null, ",")) !== FALSE) {
                $row++;
                $result = self::insert_order_from_csv($data, $order_date_time);
                if (is_int($result)) {
                    $message .= "Successfully imported order id $result" . PHP_EOL;
                } else {
                    $message .= $result . " " . json_encode(compact('file_name', 'row', 'data')) . PHP_EOL;
                    $has_error = true;
                }
            }
            fclose($file);
            
            //Archive
            if (!$has_error) {
                try {
                    rename($file_name, "archive" . DIRECTORY_SEPARATOR . $file_name);
                } catch (yii\base\Exception $e) {
                    Yii::error("Cant rename files");
                }
            }
            
        }
        return $message;
        
    }
    
    /**
     * @param string $action e.g. get_orders Follow json config
     * @param array $vars Variables. Variable names must follow json configuration
     * @return string Query string
     */
    protected function api_build_query($action = "", $vars = [])
    {
        $query_vars = $this->config->api->actions->$action->request_query_vars;
        $query_array = [];
        foreach ($query_vars as $query_var => $params) {
            $param_array = (array)$this->config->api->query;
            foreach ($params as $keys => $value_or_attributes) {
                $keys = explode('.', $keys);//e.g. shipment.shippingCarrierUsed
                $param_array_copy = $param_array;
                $pointer_to_param_to_assign =& $param_array;
                foreach ($keys as $key) {
                    if (is_array($pointer_to_param_to_assign) && !array_key_exists($key, $pointer_to_param_to_assign)) {
                        $pointer_to_param_to_assign[$key] = '';
                    }
                    $pointer_to_param_to_assign =& $pointer_to_param_to_assign[$key];
                }
                //$param_to_assign = $param_array[shipment][shippingCarrierUsed]
                if (substr($value_or_attributes, 0, 1) == ':') { // This is attributes, e.g. ":day_from" or "order.id"
                    $value_or_attributes = substr($value_or_attributes, 1);//Remove the : to make "order.id"
                    $value_or_attributes = explode('.', $value_or_attributes);// [order, id] or just [day_from]
                    $value = $vars;
                    foreach ($value_or_attributes as $attribute) {
                        $value = $value[$attribute];//go down one level, e.g. tracking[order]
                    }
                    $pointer_to_param_to_assign = $value;
                } else { // This is value, e.g. "seller"
                    $pointer_to_param_to_assign = $value_or_attributes;
                }
            }
            $query_array[$query_var] = json_encode($param_array);
        }
        if (count($query_array) == 0) {
            Yii::error("Warning: empty query string. Wrong config?");
        }
        return http_build_query($query_array);
    }
    
    /**
     * Pull orders from array we got from API
     * @param \stdClass $config The config pulled from json
     * @param array $data
     * "getOrdersResponse": {
     *    "orderArray": ":data"
     *    }
     * @return array Array of orders
     */
    public function extract_orders_from_array($data, $config = \stdClass::class)
    {
        while (is_object($config)) {
            $first_object = (array)$config;
            $data = $data[array_keys($first_object)[0]];//go down one level in data array
            $config = array_pop($first_object);//go down one level in config
            
            if ($config == ":orders") {
                return $data;
            }
        }
        return [];
    }
    
    /**
     * Insert order and order items based on config in json file
     * @param array $order An order pulled from API
     * @param \stdClass $order_keys An object that represent order structure. Pulled from mp's json file
     * @return string Message
     */
    public function insert_order_from_array($order, $order_keys = \stdClass::class):string
    {
        $message = '';
        $order_keys = json_decode(json_encode($order_keys), true);//make it an array
        $sme_order = new Order();
        
        //if order is contained within an object, such as:
        //   "order_keys": {
        //      "order": {
        //           "orderId": "channel_refnum",
        // }
        //
        // , we pull that object first
        if (count($order_keys) == 1) {
            $order = $order[array_keys($order_keys)[0]];
            $order_keys = array_pop($order_keys);//go down one level
        }
        
        foreach ($order_keys as $order_key => $mapped_sme_column) {
            $value = $order;
            $order_key = explode('.', $order_key);//transactionArray.transaction.providerName becomes [transactionArray, transaction, providerName]
            foreach ($order_key as $key) {
                $value = $value[$key];//go down on level
            }
            if (!is_array($value)) {
                $sme_order->{$mapped_sme_column} = $value;
            }
        }
        
        $sme_order->mp_id = $this->id;
        if (!$sme_order->save()) {
            Yii::error("Can not save order: " . var_export($sme_order->getErrors()));
            return "Order not saved";
        }
        //order saved. Processing order items
        $order_item_array = $this->config->order_item_array;
        $order_item_array = explode('.', $order_item_array);
        $order_items = $order;
        foreach ($order_item_array as $key) {
            $order_items = $order_items[$key];
        }
        //map array, in case each item is represented by a key => value; instead of just a plain array
        if ($this->config->order_item_array_key) {
            //flatten array one level
            $order_items = call_user_func_array('array_merge', $order_items);
            // $order_items = yii\helpers\ArrayHelper::getColumn($order_items, $this->config->order_item_array_key);
        }
        $order_item_keys = yii\helpers\ArrayHelper::toArray($this->config->order_item_keys);
        //loop through each order item
        foreach ($order_items as $order_item) {
            $sme_order_item = new OrderItem();
            $sme_order_item->order_id = $sme_order->id;
            foreach ($order_item_keys as $order_item_key => $sme_order_item_column) {
                $sme_order_item->{$sme_order_item_column} = $order_item[$order_item_key];
            }
            if (!$sme_order_item->save()) {
                $message .= "Can not save order item\n";
                Yii::error("Can not save order item: " . $sme_order_item->getErrors() . json_encode($sme_order_item));
            } else {
                $message .= "Order item " . $sme_order_item->id . "saved.\n";
            }
        }
        
        return $message;
    }
    
    public function order_import_api($day_offset = 0)
    {
        $message = "";
        if (!is_object($this->config->api)) {
            $message .= "Need api config";
            return $message;
        };
        $this->reset_parameters();
        $day_from = new \DateTime('now');
        $day_from->sub(new \DateInterval("P" . $day_offset . "D"));
        $day_from = $day_from->format('Y-m-d');
        $post_fields = $this->api_build_query('get_orders', compact('day_from'));
        $returned_data = $this->get_response($post_fields);
        
        //extract returned data
        
        $orders = $this->extract_orders_from_array($returned_data, $this->config->api->actions->get_orders->return_params);
        foreach ($orders as $order) {
            $message .= $this->insert_order_from_array($order, $this->config->order_keys);
        }
        
        return $message;
    }
    
    /**
     * Pushes all tracking to Marketplace
     */
    public function tracking_push_api()
    {
        $message = '';
        $ship_date_from = new \DateTime();
        $ship_date_from->sub((new \DateInterval("P" . TRACKING_PUSH_DAYS_BACK . "D")));
        $ship_date_from = $ship_date_from->format('Y-m-d H:i:s');
        
        $trackings = Tracking::find()->joinWith('order')->select('*')->where(['>=', 'ship_date', $ship_date_from]);

        //todob debugging
        $trackings = $trackings->andWhere(['order.channel_refnum' => '38335885']);

        $trackings = $trackings->asArray()->all();
        foreach ($trackings as $tracking) {
            // $tracking->order_id = Order::findOne(['rop_order_id'])
            $this->reset_parameters();
            $post_fields = $this->api_build_query('tracking_push', $tracking);
            $returned_data = $this->get_response($post_fields);
            $returned_data = var_export($returned_data);
            echo PHP_EOL . $returned_data . PHP_EOL;
            $message .= $returned_data;
        }
        
        // function submitTracking($orderID,$shippingCarrierUsed,$shippingTrackingNumber){
        //     $this->resetParameter();
        //     $this->args["shipment"]["shippingTrackingNumber"] = $shippingTrackingNumber;
        //     $this->args["shipment"]["shippingCarrierUsed"] = $shippingCarrierUsed;
        //     $this->args["transactionID"] = $orderID;
        //     $post_fields = "completeSaleRequest=" . urlencode(json_encode($this->args));
        //     return $this->getResponse($post_fields);
        // }
        //
        
        return $message;
    }
    
    /**
     * Update quantity of all items in inventory
     */
    public function update_quantity_api()
    {
        $message = '';
        $inventories = Inventory::find()->asArray()->all();
        foreach ($inventories as $inventory){
            
        }
    }
    
    protected function set_params($action)
    {
        
    }
    
    public function reset_parameters()
    {
        $this->curl_options = array(
            CURLOPT_HTTPHEADER => (array)$this->config->api->headers,
            CURLOPT_POST => 1,
            CURLOPT_RETURNTRANSFER => 1,
            CURLOPT_SSL_VERIFYHOST => 0,
            CURLOPT_SSL_VERIFYPEER => 0
        );
    }
    
    function get_response($post_fields)
    {
        $connection = curl_init($this->config->api->url);
        $this->curl_options[CURLOPT_POSTFIELDS] = $post_fields;
        curl_setopt_array($connection, $this->curl_options);
        $json_response = curl_exec($connection);
        if (curl_errno($connection) > 0) {
            echo curl_error($connection) . "\n";
            exit(2);
        }
        curl_close($connection);
        $response = json_decode($json_response, true);
        return $response;
    }
    
    
    /**
     * Flush all orders processed _day_offset days ago
     *
     * @param integer $day_offset
     */
    public function order_flush($day_offset = 0)
    {
        $date = new \DateTime();
        $date->sub(new \DateInterval("P" . $day_offset . "D"));//backdating
        $date = $date->format('Y-m-d');
        $sql = Yii::$app->db->createCommand('DELETE FROM `order` WHERE DATE(last_mp_updated)=:last_mp_updated;')
            ->bindValue(':last_mp_updated', $date);
        try {
            $count = $sql->execute();
            echo "$count orders flushed" . PHP_EOL;
        } catch (yii\base\Exception $e) {
            $sql = $sql->rawSql;
            Yii::error("Failed sql command $sql");
            echo "Error $sql" . PHP_EOL;
        }
        
        
    }
    
    /**
     * Pushes all tracking to Marketplace via FTP
     */
    public function tracking_push()
    {
        
    }
    
}
