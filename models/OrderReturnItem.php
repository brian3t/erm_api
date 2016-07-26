<?php

namespace app\models;

use Yii;
use \app\models\base\OrderReturnItem as BaseOrderReturnItem;

/**
 * This is the model class for table "order_return_item".
 */
class OrderReturnItem extends BaseOrderReturnItem
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return array_replace_recursive(parent::rules(),
	    [
            [['order_return_id', 'retailops_item_id', 'channel_item_refnum', 'sku', 'quantity', 'product_amt'], 'required'],
            [['order_return_id', 'retailops_item_id', 'quantity'], 'integer'],
            [['item_shipping_tax_amt', 'tax_amt', 'shipping_amt', 'restock_fee_amt', 'giftwrap_amt', 'giftwrap_tax_amt', 'product_amt', 'recycling_amt', 'subtotal_amt', 'credit_amt'], 'number'],
            [['channel_item_refnum', 'sku'], 'string', 'max' => 40],
            [['reason'], 'string', 'max' => 80]
        ]);
    }

    public function getName(){
        return "<a target='blank' href='/order-return-item/view?id={$this->id}'>{$this->orderItem->sku}</a>";
    }
}
