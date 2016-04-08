<?php

namespace app\models;

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
//  uncomment this for apigen to work
//    /** @var  stdClass $config */
    public $config = MpConfig::class;
    const ORDER_FILE_NAME_PRE = 'SHOEMETRO-ORDER';

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

        if(!$instance)
        {
            return 0;
        }
        /** @var $instance \app\models\Mp */

        $json_file_path = Yii::getAlias('@app') . DIRECTORY_SEPARATOR . "config" . DIRECTORY_SEPARATOR . "mp" . DIRECTORY_SEPARATOR . "$instance->end_point_name.json";
        if(!file_exists($json_file_path))
        {
            Yii::error("Config file not found at $json_file_path.");
            return -1;
        }
        $json_file = file_get_contents($json_file_path);
        try
        {
            $instance->config = json_decode($json_file);

        } catch (yii\base\Exception $e)
        {
            Yii::error($e);
        }
        return $instance;
    }

    /**
     * @param array $row Csv array, e.g. //Order #,Ship To Name,Ship To Address 1,Ship To Address 2,Ship To City,Ship To State,Ship To Zip,Ship Method,Product ID,Sold For,Our Cost,Qty,Description,Shipping Cost,Order Source
     * @param string $order_date_time
     * @return mixed Order id if successful. Error message if failed.
     *
     * Order //    mp_id, mp_reference_number, rop_order_id, last_mp_updated, last_rop_pull, count_rop_pull, order_date_time,  name,  company,  email,  address,  address2,  city,  state,  zip,  country,  phone,  ship_name,  ship_company,  ship_address,  ship_address2,  ship_city,  ship_state,  ship_zip,  ship_country,  ship_phone,  pay_type,  pay_transaction_id,  comments,  product_total,  tax_total,  shipping_total,  grand_total,  shipping,  discount,  status`
     * Order_item: SELECT  order_id    , sku    , product    , price_per_unit    , quantity    , status    , last_mp_updated    , mp_item_id
     */
    protected function insert_order_from_csv($row = null, $order_date_time)
    {
        $order_item = new OrderItem();
        if(empty($order_date_time))
        {
            $order_date_time = date('Y-m-d h:i:s');
        }
        $existing_mp_order = Order::findOne(['mp_id' => $this->id, 'mp_reference_number' => $row[$this->config->MP_REF_NUM_COL]]);
        if(!is_object($existing_mp_order))
        {
            $order = new Order(['mp_id' => $this->id]);
        } else
        {
            $order = $existing_mp_order;
        }
        $order_note = [];
        foreach ($this->config->order_columns as $index => $column)
        {
            if(strpos($column, 'order_item.') !== false)
            {
                $column = str_replace('order_item.', '', $column);
                $order_item->$column = $row[$index];
            } elseif(strpos($column, 'note.') !== false)
            {
                $column_name = substr($column, 5);
                $order_note[$column_name] = $row[$index];
            } else
            {
                $order->$column = $row[$index];
            }
        }

        $order->note = json_encode($order_note);
        $order->order_date_time = $order_date_time;
        $order->last_mp_updated = new yii\db\Expression('NOW()');//todob debug why this is PST timezone. It should be UTC


        if(!is_object($existing_mp_order))
        {
            if(!$order->save())
            {
                Yii::error("Failed to save order: " . $order->mp_reference_number);
                return "Failed to save order: " . $order->mp_reference_number . PHP_EOL;
            };
        } //else we don't need to save order

        $order_item->order_id = $order->id;
        if(!$order_item->save())
        {
            Yii::error("Failed to save order item" . $order_item->product);
            return "Failed to save order item" . $order_item->product . $order_item->getErrors() . PHP_EOL;
        }

        return $order->id;
    }

    /**
     * @inheritdoc
     */
    public
    function rules()
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
    public
    function order_import($day_offset = 0)
    {
        $message = "";
        if(empty($this->config->ftp->host))
        {
            $message .= "Failed";
            return $message;
        };

        // set up basic connection
        $conn_id = ftp_connect($this->config->ftp->host);

        // login with username and password
        $login_result = ftp_login($conn_id, $this->config->ftp->username, $this->config->ftp->password);
        if(!$login_result)
        {
            return $message . " Can not login to ftp\n";
        }
        ftp_pasv($conn_id, true);
        ftp_chdir($conn_id, $this->config->ftp->folder);

        $date = new \DateTime();
        $date->sub(new \DateInterval("P" . $day_offset . "D"));//backdating
        // try to DOWNLOAD $server_file and save to $local_file
        try
        {
            // get file list of current directory
            $file_list = ftp_nlist($conn_id, ".");
            if(!$file_list)
            {
                return $message . " No file found in ftp folder. Exiting.. \n";
            }
            $server_files_today = array_filter($file_list, function ($v) use ($date)
            {
                return preg_match("$" . self::ORDER_FILE_NAME_PRE . '-' . $date->format('mdy') . "-\d{6}\.csv$", $v);//filename to match: SHOEMETRO-ORDER-010116-224502.csv
            });

            //compare with local files. Also include archive folder
            chdir(Yii::getAlias('@app') . DIRECTORY_SEPARATOR . "data" . DIRECTORY_SEPARATOR . $this->end_point_name . DIRECTORY_SEPARATOR . "orders" . DIRECTORY_SEPARATOR);//var/www/sme/data/loehmanns/orders

            $local_files = array_merge(scandir("."), scandir("archive"));

            $local_files_today = array_filter($local_files, function ($v) use ($date)
            {
                return preg_match("$" . self::ORDER_FILE_NAME_PRE . '-' . $date->format('mdy') . "-\d{6}\.csv$", $v);//filename to match: SHOEMETRO-ORDER-010116-224502.csv
            });
            $server_files_today = array_diff($server_files_today, $local_files_today);
            foreach ($server_files_today as $file_name)
            {
                $message .= "Downloading $file_name..." . (ftp_get($conn_id, $file_name, $file_name, FTP_BINARY) ? " succeeded." : " failed!.");
            }
        } catch (yii\base\Exception $e)
        {
            echo "There was a problem browsing FTP site\n";
        }

        // close the connection
        ftp_close($conn_id);

        if(empty($server_files_today))
        {
            return $message;
        }

        $message .= PHP_EOL;
        //Import
        //debug:
//        $i = 0;
//        $MAX = 1;
        foreach ($server_files_today as $file_name)
        {
            preg_match('/^.*-(\d{6}).csv/', $file_name, $order_time);
            if(!isset($order_time[1]))
            {
                $message .= "No order time matched. Assume current time";
                $order_date_time = $date->format('Y-m-d h:i:s');
            } else
            {
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
            while (($data = fgetcsv($file, null, ",")) !== FALSE)
            {
                $row++;
                $result = self::insert_order_from_csv($data, $order_date_time);
                if(is_int($result))
                {
                    $message .= "Successfully imported order id $result" . PHP_EOL;
                } else
                {
                    $message .= $result . " " . json_encode(compact('file_name', 'row', 'data')) . PHP_EOL;
                    $has_error = true;
                }
            }
            //Archive
            fclose($file);
            if(!$has_error)
            {
                try{
                    rename($file_name, "archive" . DIRECTORY_SEPARATOR . $file_name);
                } catch (yii\base\Exception $e){
                    Yii::error("Cant rename files");
                }
            }

            
        }
        return $message;

    }


    /**
     * Flush all orders processed _day_offset days ago
     *
     * @param integer $day_offset
     */
    public
    function order_flush($day_offset = 0)
    {
        $date = new \DateTime();
        $date->sub(new \DateInterval("P" . $day_offset . "D"));//backdating
        $date = $date->format('Y-m-d');
        $sql = Yii::$app->db->createCommand('DELETE FROM `order` WHERE DATE(last_mp_updated)=:last_mp_updated;')
            ->bindValue(':last_mp_updated', $date);
        try
        {
            $count = $sql->execute();
            echo "$count orders flushed" . PHP_EOL;
        } catch (yii\base\Exception $e)
        {
            $sql = $sql->rawSql;
            Yii::error("Failed sql command $sql");
            echo "Error $sql" . PHP_EOL;
        }


    }


}
