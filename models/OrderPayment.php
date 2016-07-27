<?php

namespace app\models;

use Yii;
use \app\models\base\OrderPayment as BaseOrderPayment;

/**
 * This is the model class for table "order_payment".
 */
class OrderPayment extends BaseOrderPayment
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return array_replace_recursive(parent::rules(),
	    [
            [['order_id'], 'required'],
            [['order_id', 'payment_series_id'], 'integer'],
            [['amount'], 'number'],
            [['payment_processing_type', 'transaction_type'], 'string'],
            [['created_at', 'updated_at'], 'safe'],
            [['payment_type'], 'string', 'max' => 60]
        ]);
    }
    
    public function fields()
    {
        return [
            'payment_processing_type',
            'transaction_type',
            'payment_type',
            'amount'=> function () {
                return $this->getAmount();
            },
        ];
    }
    
    public function getAmount()
    {
        return floatval($this->amount);
    }
    
}
