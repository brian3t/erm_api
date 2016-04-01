<?php

namespace app\models\base;

use Yii;

/**
 * This is the base model class for table "order_item".
 *
 * @property integer $id
 * @property integer $order_id
 * @property string $sku
 * @property string $product
 * @property string $price_per_unit
 * @property integer $quantity
 * @property string $status
 * @property string $mp_item_id
 *
 * @property \app\models\Order $order
 */
class OrderItem extends \yii\db\ActiveRecord
{

    use \mootensai\relation\RelationTrait;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['order_id', 'sku'], 'required'],
            [['order_id', 'quantity'], 'integer'],
            [['price_per_unit'], 'number'],
            [['sku', 'product'], 'string', 'max' => 255],
            [['status'], 'string', 'max' => 250],
            [['mp_item_id'], 'string', 'max' => 50]
        ];
    }
    
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'order_item';
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'order_id' => 'Order ID',
            'sku' => 'Sku',
            'product' => 'Product',
            'price_per_unit' => 'Price Per Unit',
            'quantity' => 'Quantity',
            'status' => 'Status',
            'mp_item_id' => 'Mp Item ID',
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
     * @return \app\models\OrderItemQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \app\models\OrderItemQuery(get_called_class());
    }
}
