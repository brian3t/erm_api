<?php

namespace app\commands;

use app\mp\Agent;
use yii\console\Controller;

/**
 * This agent interacts with marketplaces
 *
 * @author Brian Nguyen
 */
class MpController extends Controller
{
    /**
     * This console command pulls orders from a marketplace
     * @param string $mp_id The marketplace id, such as loehmann
     * @param integer $day_offset Days ago. e.g. giving 2 will import orders two days ago
     * @return string Message
     */
    public function actionOrderImport($mp_id, $day_offset = 0)
    {
        if(is_null($mp_id))
        {
            echo "Please enter marketplace id";
            return -1;
        }

        $mp_agent = new Agent();
        $mp_agent->order_import($mp_id, $day_offset);
        return 1;
    }

    /**
     * Flush order. See details in MP model
     * @param integer $mp_id Marketplace id
     * @param integer $day_offset
     * @return string Message
     */
    public function actionOrderFlush($mp_id, $day_offset = 0){
        if(is_null($mp_id))
        {
            echo "Please enter marketplace id";
            return -1;
        }

        $mp_agent = new Agent();
        $mp_agent->order_flush($mp_id, $day_offset);
        return 1;
    }
 
}
