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
                [['mp_id', 'channel_refnum'], 'required'],
                [['mp_id', 'retailops_order_id', 'force_rop_resend', 'count_rop_pull', 'customer_id'], 'integer'],
                [['last_mp_updated', 'last_rop_pull', 'channel_date_created','rop_ack_at'], 'safe'],
                [['shipping_amt', 'tax_amt', 'product_total', 'discount_amt', 'grand_total'], 'number'],
                [['comments'], 'string'],
                [['channel_refnum', 'status'], 'string', 'max' => 50],
                [['first_name', 'company', 'email', 'address1', 'address2', 'city', 'state_match', 'country_match', 'postal_code', 'phone', 'ship_first_name', 'ship_company', 'ship_address1', 'ship_address2', 'ship_city', 'ship_state_match', 'ship_country_match', 'ship_postal_code', 'ship_phone', 'pay_type', 'pay_transaction_id', 'ship_service_code', 'attributes'], 'string', 'max' => 255],
                [['last_name', 'ship_last_name'], 'string', 'max' => 80],
                [['gift_message'], 'string', 'max' => 800],
                [['ip_address'], 'string', 'max' => 200],
                [['other_info'], 'string', 'max' => 2000],
                [['mp_id', 'channel_refnum'], 'unique', 'targetAttribute' => ['mp_id', 'channel_refnum'], 'message' => 'The combination of Mp ID and Mp Reference Number has already been taken.'],
            ]);
    }
    
    public function beforeValidate()
    {
        if (!is_string($this->channel_refnum)) {
            \Yii::warning("This order has bad mp reference number: " . json_encode($this));
        }
        $this->channel_refnum = (string)($this->channel_refnum);
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
        return ['channel_order_refnum' => 'channel_refnum', 'ship_service_code', 'currency_code' => function () {
            return $this->mp->currency_code;
        }, 'currency_values' => function () {
            return ['shipping_amt' => $this->getShipping_amt(), 'tax_amt' => $this->getTax_amt(), 'discount_amt' => $this->getDiscount_amt()];
        }, 'channel_date_created' => function () {
            return (new \DateTime($this->channel_date_created))->format('c');
        }, 'billing_address' => function () {
            return ['state_match' => $this->state_match, 'country_match' => $this->country_match, 'last_name' => $this->last_name, 'address2' => $this->address2,
                'city' => $this->city, 'postal_code' => $this->postal_code, 'address1' => $this->address1, 'company' => $this->company, 'first_name' => $this->first_name];
        }, 'shipping_address' => function () {
            return ['state_match' => $this->ship_state_match??'', 'country_match' => $this->ship_country_match??'', 'last_name' => $this->ship_last_name, 'address2' => $this->ship_address2,
                'city' => $this->ship_city, 'postal_code' => $this->ship_postal_code, 'address1' => $this->ship_address1, 'company' => $this->ship_company??'', 'first_name' => $this->ship_first_name];
        },
            'order_items' => 'orderItems',
            'gift_message', 'payment_transactions' => 'orderPayments',
            'customer_info' => function () {
                return is_object($this->customer) ? $this->customer : ["email_address" => "N/A",
                    "full_name" => "N/A",
                    "phone_number" => "N/A",
                ];
            }, 'attributes' => 'rop_attributes', 'ip_address',];
    }
    
    public function getRop_attributes()
    {
        return [
            ['attribute_type' => 'text',//text number select multiselect price
                'handle' => 'customer_rewards_number',
            ],
            ['attribute_type' => 'number',//text  select multiselect price
                'handle' => 'test_number',
            ],
            ['attribute_type' => 'select',//text number  multiselect price
                'handle' => 'test_select',
            ],
            ['attribute_type' => 'multiselect',//text number select  price
                'handle' => 'test_multiselect',
            ],
            ['attribute_type' => 'price',//text number select multiselect
                'handle' => 'test_price',
            ],
        ];
    }
    
    public function getDiscount_amt()
    {
        return floatval($this->discount_amt);
    }
    
    public function getShipping_amt()
    {
        return floatval($this->shipping_amt);
    }
    
    public function getTax_amt()
    {
        return floatval($this->tax_amt);
    }
    
    
    public function extraFields()
    {
        return ['ship_company', 'ship_address', 'ship_address2', 'ship_city', 'ship_state', 'ship_zip', 'ship_country',
        ];
    }

    /**
     * @return array
     */
    public function getOther_info()
    {
        return json_decode($this->other_info, JSON_OBJECT_AS_ARRAY);
    }
    
    public function setOther_info($other_info){
        if (is_array($other_info)){
            $other_info = json_encode($other_info);
        }
        $this->other_info = $other_info;
    }
    
}
