<?php

namespace app\models\base;

use Yii;
use yii\behaviors\TimestampBehavior;

/**
 * This is the base model class for table "order".
 *
 * @property integer $id
 * @property integer $mp_id
 * @property string $mp_reference_number
 * @property integer $rop_order_id
 * @property string $last_mp_updated
 * @property string $last_rop_pull
 * @property integer $force_rop_resend
 * @property integer $count_rop_pull
 * @property string $order_date_time
 * @property string $name
 * @property string $company
 * @property string $email
 * @property string $address
 * @property string $address2
 * @property string $city
 * @property string $state
 * @property string $zip
 * @property string $country
 * @property string $phone
 * @property string $ship_name
 * @property string $ship_company
 * @property string $ship_address
 * @property string $ship_address2
 * @property string $ship_city
 * @property string $ship_state
 * @property string $ship_zip
 * @property string $ship_country
 * @property string $ship_phone
 * @property string $pay_type
 * @property string $pay_transaction_id
 * @property string $comments
 * @property string $product_total
 * @property string $tax_total
 * @property string $shipping_total
 * @property string $grand_total
 * @property string $shipping
 * @property string $discount
 * @property string $status
 * @property string $note
 *
 * @property \app\models\Mp $mp
 * @property \app\models\OrderItem[] $orderItems
 * @property \app\models\Tracking[] $trackings
 */
class Order extends \yii\db\ActiveRecord
{

    use \mootensai\relation\RelationTrait;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['mp_id', 'mp_reference_number'], 'required'],
            [['mp_id', 'rop_order_id', 'force_rop_resend', 'count_rop_pull'], 'integer'],
            [['last_mp_updated', 'last_rop_pull', 'order_date_time'], 'safe'],
            [['comments'], 'string'],
            [['product_total', 'tax_total', 'shipping_total', 'grand_total', 'discount'], 'number'],
            [['mp_reference_number', 'status'], 'string', 'max' => 50],
            [['name', 'company', 'email', 'address', 'address2', 'city', 'state', 'zip', 'country', 'phone', 'ship_name', 'ship_company', 'ship_address', 'ship_address2', 'ship_city', 'ship_state', 'ship_zip', 'ship_country', 'ship_phone', 'pay_type', 'pay_transaction_id', 'shipping', 'note'], 'string', 'max' => 255],
            [['mp_id', 'mp_reference_number'], 'unique', 'targetAttribute' => ['mp_id', 'mp_reference_number'], 'message' => 'The combination of Mp ID and Mp Reference Number has already been taken.']
        ];
    }
    
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'order';
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'mp_id' => 'Mp ID',
            'mp_reference_number' => 'Mp Ref#',
            'rop_order_id' => 'Rop Order ID',
            'last_mp_updated' => 'Last Mp Updated',
            'last_rop_pull' => 'Last Rop Pull',
            'force_rop_resend' => 'Force ROP Resend',
            'count_rop_pull' => 'Count Rop Pull',
            'order_date_time' => 'Order Datetime',
            'name' => 'Name',
            'company' => 'Company',
            'email' => 'Email',
            'address' => 'Address',
            'address2' => 'Address2',
            'city' => 'City',
            'state' => 'State',
            'zip' => 'Zip',
            'country' => 'Country',
            'phone' => 'Phone',
            'ship_name' => 'Ship Name',
            'ship_company' => 'Ship Company',
            'ship_address' => 'Ship Address',
            'ship_address2' => 'Ship Address2',
            'ship_city' => 'Ship City',
            'ship_state' => 'Ship State',
            'ship_zip' => 'Ship Zip',
            'ship_country' => 'Ship Country',
            'ship_phone' => 'Ship Phone',
            'pay_type' => 'Pay Type',
            'pay_transaction_id' => 'Pay Transaction ID',
            'comments' => 'Comments',
            'product_total' => 'Product Σ',
            'tax_total' => 'Tax Σ',
            'shipping_total' => 'Shipping Σ',
            'grand_total' => 'Grand Σ',
            'shipping' => 'Shipping',
            'discount' => 'Discount',
            'status' => 'Status',
            'note' => 'Note',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMp()
    {
        return $this->hasOne(\app\models\Mp::className(), ['id' => 'mp_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getOrderItems()
    {
        return $this->hasMany(\app\models\OrderItem::className(), ['order_id' => 'id']);
    }

    public function getTrackings()
    {
        return $this->hasMany(\app\models\Tracking::className(), ['rop_order_id' => 'rop_order_id']);
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
                'createdAtAttribute' => false,
                'updatedAtAttribute' => 'last_mp_updated',
                'value' => new \yii\db\Expression('NOW()'),
            ],
        ];
    }

    /**
     * @inheritdoc
     * @return \app\models\OrderQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \app\models\OrderQuery(get_called_class());
    }
}
