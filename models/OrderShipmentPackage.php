<?php

namespace app\models;

use Yii;
use \app\models\base\OrderShipmentPackage as BaseOrderShipmentPackage;

/**
 * This is the model class for table "order_shipment_package".
 */
class OrderShipmentPackage extends BaseOrderShipmentPackage
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return array_replace_recursive(parent::rules(),
	    [
            [['order_shipment_id', 'retailops_package_id'], 'required'],
            [['order_shipment_id', 'retailops_package_id'], 'integer'],
            [['weight_kg'], 'number'],
            [['date_shipped', 'created_at', 'updated_at'], 'safe'],
            [['carrier_name'], 'string', 'max' => 200],
            [['carrier_class_name', 'channel_ship_code'], 'string', 'max' => 40],
            [['tracking_number'], 'string', 'max' => 30],
            [['tracking_number'], 'unique']
        ]);
    }
	
}
