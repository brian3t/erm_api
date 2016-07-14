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
                [['order_id'], 'integer'],
                [['amount'], 'number'],
                [['type', 'payment_type'], 'string'],
                [['created_at', 'updated_at'], 'safe']
            ]);
    }
    
    public function fields()
    {
        return [
            'amount', 'type', 'channel_refnum' => function(){return $this->payment_type;}, 'payment_type'
            , 'payment_params' => function () {
                return ["channel_refnum" => 496, "payment_type" => $this->payment_type];
            }
        ];
    }
    
}
