<?php

namespace app\models;

use Yii;
use \app\models\base\Tracking as BaseTracking;

/**
 * This is the model class for table "tracking".
 */
class Tracking extends BaseTracking
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return array_replace_recursive(parent::rules(),
	    [
            [['retailops_order_id'], 'integer'],
            [['ship_date'], 'safe'],
            [['sku', 'tracking_number', 'tracking_carrier'], 'string', 'max' => 45]
        ]);
    }
	
}
