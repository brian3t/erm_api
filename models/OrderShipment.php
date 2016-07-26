<?php

namespace app\models;

use Yii;
use \app\models\base\OrderShipment as BaseOrderShipment;

/**
 * This is the model class for table "order_shipment".
 */
class OrderShipment extends BaseOrderShipment
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return array_replace_recursive(parent::rules(),
	    [
            [['order_id', 'retailops_shipment_id'], 'required'],
            [['order_id', 'retailops_shipment_id'], 'integer'],
            [['created_at', 'updated_at'], 'safe'],
            [['retailops_shipment_id'], 'unique']
        ]);
    }
	
}
