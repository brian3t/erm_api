<?php
namespace app\mp;


use app\models\Event;
use app\models\Mp;
use yii\db\Expression;


/**
 * Class Agent
 * @package app\mp
 *
 * This is Agent. Responsible for interacting with mp
 */
class Agent
{
    /**
     * @param string $mp_id
     * @param integer $day_offset Days ago. Giving 2 will import orders two days ago
     */
    public function order_import($mp_id, $day_offset = 0)
    {
        $event = new Event();
        $event->mp_id = $mp_id;
        $event->action = "MP order import";
        $event->note = "Params: day_offset: $day_offset".PHP_EOL;
        $event->start = time();

        echo "Marketplace id: $mp_id \n";

        $mp = Mp::findOne($mp_id);
        echo $mp->name ?? "Marketplace not found. Wrong id?\n";
        echo $mp->config->ftp->host ?? "FTP host missing\n";
        echo "\n";
        echo "Start pulling..";
        $message = $mp->order_import($day_offset). PHP_EOL;
        echo PHP_EOL.$message.PHP_EOL;
        $event->note = $message;
        $event->stop = new Expression('NOW()');
        $event->save();
    }

    /**
     * Flush orders. See details in MP model
     * @param $mp_id
     * @param int $day_offset
     */
    public function order_flush($mp_id, $day_offset = 0)
    {
        $mp = Mp::findOne($mp_id);
        echo "\n" . $mp->order_flush($day_offset);
    }
}