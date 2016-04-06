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
            [['price_per_unit'], 'number'],
            [['last_mp_updated'], 'safe'],
            [['sku', 'product'], 'string', 'max' => 255],
            [['options'], 'string', 'max' => 2550],
            [['status'], 'string', 'max' => 250],
            [['mp_item_id'], 'string', 'max' => 50]
        ]);
    }
	
}
