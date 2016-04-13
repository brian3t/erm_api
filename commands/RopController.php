<?php

namespace app\commands;

use app\rop\Agent;
use yii\console\Controller;

/**
 * This simulates ROP
 *
 * @author Brian Nguyen
 */
class RopController extends Controller
{
    /**
     * This console command pulls orders from a SME.
     * It then calls OrderPush with rop_order_id updated
     * All events are logged
     * @param string $mp_id The marketplace id, such as loehmann
     * @param integer $day_offset Days ago. e.g. giving 2 will import orders two days ago
     * @return string Message
     */
    public function actionOrderPull($mp_id, $day_offset = 0)
    {
        if(is_null($mp_id))
        {
            echo "Please enter marketplace id";
            return -1;
        }

        $rop_agent = new Agent();
        $orders = $rop_agent->order_pull($mp_id, $day_offset);
        
        return 1;
    }
    
    /**
     * Simulate tracking push. More details in /rop/Agent.php/actionTrackingPush
     * @param $mp_id
     * @return int
     */
    public function actionSimTrackingPush($mp_id)
    {
        if(is_null($mp_id))
        {
            echo "Please enter marketplace id";
            return -1;
        }
        
        $rop_agent = new Agent();
        echo $rop_agent->tracking_push($mp_id);
        
        return 1;
    }
    
    
    public function actionOrderClearRid($mp_id)
    {
        if(is_null($mp_id))
        {
            echo "Please enter marketplace id";
            return -1;
        }

        $command = \Yii::$app->db->createCommand("UPDATE `order` SET rop_order_id = NULL WHERE mp_id=:mp_id")
        ->bindValue(':mp_id', $mp_id);
        $affected_rows = $command->execute();
        \Yii::warning("Warning, ROP ID reset". $affected_rows);
        echo "Cleared ROP Order ID for: ". $affected_rows . " records." . PHP_EOL;
        return 1;
    }
}
