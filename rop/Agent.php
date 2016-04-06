<?php
namespace app\rop;

define('BASE_URL', 'http://brianng/api/v1/');

use app\models\Event;
use app\models\Mp;
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
    public function order_pull($mp_id, $day_offset = 0)
    {
        $event = new Event();
        $event->mp_id = $mp_id;
        $event->action = "SME order pull";
        $event->note = "Params: day_offset: $day_offset" . PHP_EOL;
        $event->start = time();

        echo "Marketplace id: $mp_id \n";

        $message = '';
        $orders = [];
        // create a new cURL resource
        $ch = curl_init();

        // set URL and other appropriate options
        curl_setopt($ch, CURLOPT_URL, BASE_URL . 'orders');
        curl_setopt($ch, CURLOPT_HEADER, 0);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        // grab URL and pass it to the browser
        $orders = curl_exec($ch);

        // close cURL resource, and free up system resources
        curl_close($ch);

        $event->note = $message;
        $event->stop = new Expression('NOW()');
        $event->save();

        return $orders;
    }

}