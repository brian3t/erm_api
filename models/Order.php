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
                [['mp_id', 'rop_order_id', 'force_rop_resend', 'count_rop_pull'], 'integer'],
                [['last_mp_updated', 'last_rop_pull', 'order_date_time'], 'safe'],
                [['comments'], 'string'],
                [['product_total', 'tax_total', 'shipping_total', 'grand_total', 'discount'], 'number'],
                [['mp_reference_number', 'status'], 'string', 'max' => 50],
                [['name', 'company', 'email', 'address', 'address2', 'city', 'state', 'zip', 'country', 'phone', 'ship_name', 'ship_company', 'ship_address', 'ship_address2', 'ship_city', 'ship_state', 'ship_zip', 'ship_country', 'ship_phone', 'pay_type', 'pay_transaction_id', 'shipping', 'note'], 'string', 'max' => 255],
                [['mp_id', 'mp_reference_number'], 'unique', 'targetAttribute' => ['mp_id', 'mp_reference_number'], 'message' => 'The combination of Mp ID and Mp Reference Number has already been taken.']
            ]);
    }

    public function beforeValidate() {
        if (!is_string($this->mp_reference_number)){
            \Yii::warning("This order has bad mp reference number: ". json_encode($this));
        }
        $this->mp_reference_number = (string)($this->mp_reference_number);
        return parent::beforeValidate();
    }
    
    public function beforeSave($insert)
    {
        
        //standardize date time
        $this->order_date_time = date('Y-m-d H:i:s', strtotime($this->order_date_time));
       if (empty($this->name)){
           $this->name = $this->ship_name;
       };

       if (empty($this->company)){
           $this->company = $this->ship_company;
       };

       if (empty($this->address)){
           $this->address = $this->ship_address;
       };

       if (empty($this->address2)){
           $this->address2 = $this->ship_address2;
       };

       if (empty($this->city)){
           $this->city = $this->ship_city;
       };

       if (empty($this->state)){
           $this->state = $this->ship_state;
       };
       if (empty($this->zip)){
           $this->zip = $this->ship_zip;
       };

       if (empty($this->country)){
           $this->country = $this->ship_country;
       };

       if (empty($this->phone)){
           $this->phone = $this->ship_phone;
       };

        return parent::beforeSave($insert);
    }

    public function getNote()
    {
        $result = "N / A";
        try
        {
            $note = json_decode($this->note, true);
            if(is_array($note))
            {
                $result = "";
                foreach ($note as $key => $value)
                {
                    $result .= ucwords(str_replace('_', ' ', $key));
                    $result .= " : $value\n";
                }
            }
        } catch (Exception $e)
        {
            Yii::error($e);
        }
        return $result;
    }

    /**
     * @return array Fields for REST API calls
     */
    public function fields()
    {
        return ['id', 'mp_reference_number', 'rop_order_id', 'last_mp_updated', 'order_date_time', 'shipping', 'ship_name'];
    }

    public function extraFields()
    {
        return ['ship_company', 'ship_address', 'ship_address2', 'ship_city', 'ship_state', 'ship_zip', 'ship_country',
        ];
    }

}
