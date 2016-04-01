<?php
namespace app\mp;


use app\models\Event;

class Agent
{
    /**
     * @param string $mp_id
     */
    public function order_import($mp_id){
        $event = new Event();
        $event->mp_id = $mp_id;
        $event->note = "Testing";
        $event->save();
        echo "Marketplace id: $mp_id \n";
        return "Done pulling\n";
    }
}