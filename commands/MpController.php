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
     * This command pulls orders from a marketplace
     * @param string $mp_id The marketplace id, such as loehmann
     */
    public function actionIndex($mp_id)
    {
        if (is_null($mp_id)){
            echo "Please enter marketplace id";
            return -1;
        }

        $mp_agent = new Agent();
        echo $mp_agent->order_import($mp_id);
        return 1;
    }
}
