<?php
namespace app\rop;

use app\models\base\Order;
use app\models\Event;
use app\models\Mp;
use Faker\Provider\DateTime;
use yii\base\Exception;
use yii\db\Expression;


/**
 * Class Agent
 * @package app\rop
 *
 * This simulates ROP interacting with SME
 */
class Agent
{
    /**
     * Simulate ROP pulls order from SME
     * @param string $mp_id Marketplace id
     * @param integer $day_offset Days ago. Giving 2 will import orders two days ago
     * @return array Orders
     */
    public function order_pull($mp_id, $day_offset = 0) {
        $event = new Event();
        $event->mp_id = $mp_id;
        $event->action = "ROP ORDER PULL";
        $event->note = "Params: day_offset: $day_offset" . PHP_EOL;
        $event->start = time();

        echo "Marketplace id: $mp_id \n";

        $message = '';
        $orders = [];
        // create a new cURL resource
        $ch = curl_init();
        $curl_options = [
            CURLOPT_URL => BASE_SME_API_URL . 'order',
            CURLOPT_SSL_VERIFYPEER => false,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_HEADER => [
                'Accept: application/json'
            ]
        ];
        // set URL and other appropriate options
        curl_setopt_array($ch, $curl_options);
        // grab orders
        $response = curl_exec($ch);
        $header_size = curl_getinfo($ch, CURLINFO_HEADER_SIZE);
        $header = substr($response, 0, $header_size);
        $body = substr($response, $header_size);
        // close cURL resource, and free up system resources
        curl_close($ch);
        try {
            $orders = json_decode($body);
        } catch (Exception $e) {
            \Yii::error($e);
            $orders = [];
        }
        $event->note = $message . "\nCount: " . count($orders);
        $event->stop = new Expression('NOW()');
        $event->save();

        if (!is_array($orders)){
            $message.= "No orders received";
            echo $message;
            return [];
        }
        //Populating ROP Order ID
        $order_array = [];
        foreach ($orders as $order) {
            /** @var Order $order */
            $order_array[$order->id] = rand(5000, 10000000);//simulate ROP ORDER ID
        }

        //Order Confirmation: Inform SME with ROP Order ID
        $data_to_send = json_encode($order_array, JSON_FORCE_OBJECT);
        // create a new cURL resource
        $ch = curl_init();
        $curl_options = [
            CURLOPT_URL => BASE_SME_API_URL . 'order/confirm',
            CURLOPT_POST => true,
            CURLOPT_SSL_VERIFYPEER => false,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_HTTPHEADER => [
                'Accept: application/json',
                'Content-Type:application/json',
                'Content-Length: ' . strlen($data_to_send)
            ],
            CURLOPT_POSTFIELDS => $data_to_send
        ];

        // set URL and other appropriate options
        curl_setopt_array($ch, $curl_options);
        // grab orders
        $response = curl_exec($ch);
        $header_size = curl_getinfo($ch, CURLINFO_HEADER_SIZE);
        $header = substr($response, 0, $header_size);
        $body = substr($response, $header_size);
        // close cURL resource, and free up system resources
        curl_close($ch);
        return $body;
    }

    /**
     * Simulate tracking push from ROP to SME
     * @param int $mp_id Marketplace id
     */
    public function tracking_push($mp_id){
        $message = '';
        $event = new Event();
        $event->mp_id = $mp_id;
        $event->action = "ROP ORDER PULL";
        $event->start = time();
        echo "Marketplace: ". (Mp::findOne($mp_id)->end_point_name) . "\n";
        //sample data
        $sample_orders_rop_ids = Order::find()->select('retailops_order_id')->where(['mp_id' => $mp_id])->andWhere(['not', ['retailops_order_id'=>null]])->limit(11)->asArray()->all();
        $sample_orders_rop_ids = \yii\helpers\ArrayHelper::getColumn($sample_orders_rop_ids, 'retailops_order_id');
        $sample_orders = [];
        $today = new \DateTime();

        $tracking_carriers = ['DHL Express', 'FedEx', 'USPS Ground', 'Amazon'];
        foreach ($sample_orders_rop_ids as $sample_orders_rop_id){
            $date_interval = rand(0, 3);
            if (!empty($date_interval)){
                $today->sub(new \DateInterval("P" . $date_interval . "D"));
            }
            $ship_date = $today->format('Y-m-d H:i:s');
            $sample_orders[$sample_orders_rop_id] = [
              'sku' => uniqid(),
                'tracking_number' => uniqid() . uniqid(),
                'tracking_carrier' => $tracking_carriers[rand(0, 3)],
                'ship_date' => $ship_date
            ];
        }
        $sample_orders = json_encode($sample_orders);
        // create a new cURL resource
        $ch = curl_init();
        $curl_options = [
            CURLOPT_URL => BASE_SME_API_URL . 'tracking/push',
            CURLOPT_POST => true,
            CURLOPT_SSL_VERIFYPEER => false,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_HTTPHEADER => [
                'Accept: application/json',
                'Content-Type:application/json',
                'Content-Length: ' . strlen($sample_orders)
            ],
            CURLOPT_POSTFIELDS => $sample_orders
        ];

        // set URL and other appropriate options
        curl_setopt_array($ch, $curl_options);
        // grab orders
        $response = curl_exec($ch);
        $header_size = curl_getinfo($ch, CURLINFO_HEADER_SIZE);
        $header = substr($response, 0, $header_size);
        $body = substr($response, $header_size);
        $body = json_decode($body);
        // close cURL resource, and free up system resources
        curl_close($ch);

        $header = json_decode($header, true);

        $orders_updated = $header['count']??"Something wrong. Header received: $header. Response received: $response";
        $event->note = $message . "\nCount: " . $orders_updated . "\n";
        $event->stop = new Expression('NOW()');
        $event->save();

        $message.=$orders_updated . " orders updated.\n";
        return $message;
    }

}