<?php

namespace app\models;

use Yii;
use \app\models\base\OrderReturn as BaseOrderReturn;

/**
 * This is the model class for table "order_return".
 */
class OrderReturn extends BaseOrderReturn
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return array_replace_recursive(parent::rules(),
	    [
            [['order_id'], 'required'],
            [['order_id', 'retailops_return_id', 'retailops_rma_id'], 'integer'],
            [['product_amt', 'subtotal_amt', 'discount_amt', 'shipping_amt', 'tax_amt', 'refund_amt'], 'number'],
            [['created_at', 'updated_at'], 'safe']
        ]);
    }
	
}
