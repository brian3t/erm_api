<?php

namespace app\models;

use Yii;
use \app\models\base\Order as BaseOrder;

/**
 * This is the model class for table "order".
 */
class Order extends BaseOrder
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return array_replace_recursive(parent::rules(),
	    [
            [['mp_id', 'mp_reference_number'], 'required'],
            [['mp_id', 'rop_order_id', 'count_rop_pull'], 'integer'],
            [['last_mp_updated', 'last_rop_pull', 'order_date_time'], 'safe'],
            [['comments'], 'string'],
            [['product_total', 'tax_total', 'shipping_total', 'grand_total', 'discount'], 'number'],
            [['mp_reference_number', 'status'], 'string', 'max' => 50],
            [['name', 'company', 'email', 'address', 'address2', 'city', 'state', 'zip', 'country', 'phone', 'ship_name', 'ship_company', 'ship_address', 'ship_address2', 'ship_city', 'ship_state', 'ship_zip', 'ship_country', 'ship_phone', 'pay_type', 'pay_transaction_id', 'shipping'], 'string', 'max' => 255],
            [['mp_id', 'mp_reference_number'], 'unique', 'targetAttribute' => ['mp_id', 'mp_reference_number'], 'message' => 'The combination of Mp ID and Mp Reference Number has already been taken.']
        ]);
    }
	
}
