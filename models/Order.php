<?php

namespace app\models;

use Yii;
use \app\models\base\Order as BaseOrder;
use yii\base\Exception;

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
                [['mp_id', 'rop_order_id', 'force_rop_resend', 'count_rop_pull', 'customer_id'], 'integer'],
                [['last_mp_updated', 'last_rop_pull', 'channel_date_created'], 'safe'],
                [['shipping_amt', 'tax_amt', 'product_total', 'discount_amt', 'grand_total'], 'number'],
                [['comments'], 'string'],
                [['mp_reference_number', 'status'], 'string', 'max' => 50],
                [['first_name', 'company', 'email', 'address1', 'address2', 'city', 'state_match', 'country_match', 'postal_code', 'phone', 'ship_first_name', 'ship_company', 'ship_address1', 'ship_address2', 'ship_city', 'ship_state_match', 'ship_country_match', 'ship_postal_code', 'ship_phone', 'pay_type', 'pay_transaction_id', 'shipcode', 'note'], 'string', 'max' => 255],
                [['last_name', 'ship_last_name'], 'string', 'max' => 80],
                [['gift_message'], 'string', 'max' => 800],
                [['ip_address'], 'string', 'max' => 200],
                [['mp_id', 'mp_reference_number'], 'unique', 'targetAttribute' => ['mp_id', 'mp_reference_number'], 'message' => 'The combination of Mp ID and Mp Reference Number has already been taken.']
            ]);
    }

    public function beforeValidate()
    {
        if (!is_string($this->mp_reference_number)) {
            \Yii::warning("This order has bad mp reference number: " . json_encode($this));
        }
        $this->mp_reference_number = (string)($this->mp_reference_number);
        return parent::beforeValidate();
    }
    
    public function beforeSave($insert)
    {
        
        //standardize date time
        $this->channel_date_created = date('Y-m-d H:i:s', strtotime($this->channel_date_created));
        if (empty($this->company)) {
            $this->company = $this->ship_company;
        };

        if (empty($this->address1)) {
            $this->address1 = $this->ship_address1;
        };

        if (empty($this->address2)) {
            $this->address2 = $this->ship_address2;
        };

        if (empty($this->city)) {
            $this->city = $this->ship_city;
        };

        if (empty($this->state_match)) {
            $this->state_match = $this->ship_state_match;
        };
        if (empty($this->postal_code)) {
            $this->postal_code = $this->ship_postal_code;
        };

        if (empty($this->country_match)) {
            $this->country_match = $this->ship_country_match;
        };

        if (empty($this->phone)) {
            $this->phone = $this->ship_phone;
        };

        return parent::beforeSave($insert);
    }

    public function getNote()
    {
        $result = "N / A";
        try {
            $note = json_decode($this->note, true);
            if (is_array($note)) {
                $result = "";
                foreach ($note as $key => $value) {
                    $result .= ucwords(str_replace('_', ' ', $key));
                    $result .= " : $value\n";
                }
            }
        } catch (Exception $e) {
            Yii::error($e);
        }
        return $result;
    }

    /**
     * @return array Fields for REST API calls
     */
    public function fields()
    {
        return ['id', 'marketplace' => function ($model) {
            return $model->mp->name;
        }, 'mp_reference_number', 'rop_order_id', 'last_mp_updated', 'order_date_time', 'shipping', 'ship_name'];
    }

    public function extraFields()
    {
        return ['ship_company', 'ship_address', 'ship_address2', 'ship_city', 'ship_state', 'ship_zip', 'ship_country',
        ];
    }

}
