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
        if (!$this->checkMp($mp_id)){
            return false;
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
        if (!$this->checkMp($mp_id)){
            return false;
        }

        $mp_agent = new Agent();
        $mp_agent->order_flush($mp_id, $day_offset);
        return 1;
    }
    
    /**
     * Pushes all tracking to a marketplace. More details at mp/Agent.php
     * @param integer $mp_id Marketplace id
     * @return string Status
     */
    public function actionTrackingPush($mp_id){
        if (!$this->checkMp($mp_id)){
            return false;
        }
    
        $mp_agent = new Agent();
        $mp_agent->tracking_push($mp_id);
        return 1;
    }
    
    private function checkMp($mp_id){
        if(is_null($mp_id))
        {
            echo "Please enter marketplace id";
            return false;
        }
        else {
            return true;
        }
    }
    
    /**
     * Update quantity
     * More details inside models/Mp.php
     */
    public function quantity_update($mp_id)
    {
        if (!$this->checkMp($mp_id)){
            return false;
        }
    
        $mp_agent = new Agent();
        $mp_agent->quantity_update($mp_id);
        return 1;
    }
}
