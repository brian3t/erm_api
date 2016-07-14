<?php

namespace app\models\base;

use Yii;
use yii\behaviors\TimestampBehavior;

/**
 * This is the base model class for table "order_item".
 *
 * @property integer $id
 * @property integer $order_id
 * @property string $sku
 * @property string $sku_title
 * @property string $options
 * @property string $unit_price
 * @property integer $quantity
 * @property string $status
 * @property string $last_mp_updated
 * @property string $mp_item_id
 * @property string $extra_info
 * @property string $unit_tax
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
            [['unit_price', 'unit_tax'], 'number'],
            [['last_mp_updated'], 'safe'],
            [['sku'], 'string', 'max' => 255],
            [['sku_title', 'extra_info'], 'string', 'max' => 800],
            [['options'], 'string', 'max' => 2550],
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
            'sku_title' => 'Sku Title',
            'options' => 'Options',
            'unit_price' => 'Unit Price',
            'quantity' => 'Quantity',
            'status' => 'Status',
            'last_mp_updated' => 'Last Mp Updated',
            'mp_item_id' => 'Mp Item ID',
            'extra_info' => 'Extra Info',
            'unit_tax' => 'Unit Tax',
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
     * @return \app\models\OrderItemQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \app\models\OrderItemQuery(get_called_class());
    }
}
