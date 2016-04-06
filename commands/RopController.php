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

}
