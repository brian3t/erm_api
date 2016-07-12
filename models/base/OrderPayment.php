<?php

namespace app\models\base;

use Yii;
use yii\behaviors\TimestampBehavior;

/**
 * This is the base model class for table "order_payment".
 *
 * @property integer $id
 * @property integer $order_id
 * @property string $amount
 * @property string $type
 * @property string $payment_type
 * @property string $created_at
 * @property string $updated_at
 *
 * @property \app\models\Order $order
 */
class OrderPayment extends \yii\db\ActiveRecord
{

    use \mootensai\relation\RelationTrait;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['order_id'], 'required'],
            [['order_id'], 'integer'],
            [['amount'], 'number'],
            [['type', 'payment_type'], 'string'],
            [['created_at', 'updated_at'], 'safe']
        ];
    }
    
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'order_payment';
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'order_id' => 'Order ID',
            'amount' => 'Amount',
            'type' => 'Type',
            'payment_type' => 'Payment Type',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getOrder()
    {
        return $this->hasOne(\app\models\Order::className(), ['id' => 'order_id']);
    }

/**
     * @inheritdoc
     * @return type mixed
     */ 
    public function behaviors()
    {
        return [
            [
                'class' => TimestampBehavior::className(),
                'createdAtAttribute' => 'created_at',
                'updatedAtAttribute' => 'updated_at',
                'value' => new \yii\db\Expression('NOW()'),
            ],
        ];
    }

    /**
     * @inheritdoc
     * @return \app\models\OrderPaymentQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \app\models\OrderPaymentQuery(get_called_class());
    }
}
