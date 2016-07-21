<?php

namespace app\models;

use Yii;
use \app\models\base\Customer as BaseCustomer;

/**
 * This is the model class for table "customer".
 */
class Customer extends BaseCustomer
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return array_replace_recursive(parent::rules(),
	    [
            [['created_at', 'updated_at'], 'safe'],
            [['first_name', 'email_address', 'mp_customer_id'], 'string', 'max' => 255],
            [['last_name'], 'string', 'max' => 80],
            [['company'], 'string', 'max' => 800],
            [['phone_number'], 'string', 'max' => 20]
        ]);
    }
    
    public function fields()
    {
        return ['email_address','full_name', 'phone_number'];
    }
    public function getFull_name(){
        return implode(' ', [$this->first_name, $this->last_name]);
    }
    
}
