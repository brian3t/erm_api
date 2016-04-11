<?php
namespace app\rop;

define('BASE_URL', 'http://api.brianng/v1/');

use app\models\base\Order;
use app\models\Event;
use app\models\Mp;
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
     * @param string $mp_id
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
            CURLOPT_URL => BASE_URL . 'order',
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
            CURLOPT_URL => BASE_URL . 'order/confirm',
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

}