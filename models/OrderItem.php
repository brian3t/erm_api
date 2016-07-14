<?php

namespace app\models;

use Yii;
use \app\models\base\OrderItem as BaseOrderItem;

/**
 * This is the model class for table "order_item".
 */
class OrderItem extends BaseOrderItem
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return array_replace_recursive(parent::rules(),
	    [
            [['order_id', 'sku'], 'required'],
            [['order_id', 'quantity'], 'integer'],
            [['unit_price', 'unit_tax'], 'number'],
            [['last_mp_updated'], 'safe'],
            [['sku'], 'string', 'max' => 255],
            [['sku_title', 'extra_info'], 'string', 'max' => 800],
            [['options'], 'string', 'max' => 2550],
            [['status'], 'string', 'max' => 250],
            [['mp_item_id'], 'string', 'max' => 50]
        ]);
    }
    public function beforeValidate() {
        $this->mp_item_id = strval($this->mp_item_id);
        return parent::beforeValidate();
    }
    public function fields()
    {
        return ['channel_refnum'=>function(){return $this->order->channel_refnum;}, 'sku', 'unit_tax', 'quantity', 'sku_title', 'unit_price'];
    }
    
}
