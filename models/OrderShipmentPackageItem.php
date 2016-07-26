<?php

namespace app\models;

use Yii;
use \app\models\base\OrderShipmentPackageItem as BaseOrderShipmentPackageItem;

/**
 * This is the model class for table "order_shipment_package_item".
 *
 * @property string $name
 */
class OrderShipmentPackageItem extends BaseOrderShipmentPackageItem
{
    public $name;
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return array_replace_recursive(parent::rules(),
	    [
            [['order_shipment_package_id'], 'required'],
            [['order_shipment_package_id', 'retailops_order_item_id', 'retailops_shipment_item_id', 'quantity'], 'integer'],
            [['created_at', 'updated_at'], 'safe'],
            [['sku'], 'string', 'max' => 40],
            [['rop_channel_item_refnum'], 'string', 'max' => 20]
        ]);
    }
    
    public function getName(){
        $order_item_id = $this->orderItem->id;
        return "Order item: <a target='_blank' href='/order-item/view?id=$order_item_id'>{$this->orderItem->sku_description}</a>";
    }
	
}
