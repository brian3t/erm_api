<?php

namespace app\models;

use Yii;
use \app\models\base\MkInternet as BaseMkInternet;

/**
 * This is the model class for table "mk_internet".
 */
class MkInternet extends BaseMkInternet
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return array_replace_recursive(parent::rules(),
	    [
            [['marketing_id', 'company_id'], 'required'],
            [['marketing_id', 'company_id', 'promo_tickets', 'qty'], 'integer'],
            [['created_at', 'updated_at', 'promo_run_from', 'promo_run_to', 'paid_run_from', 'paid_run_to'], 'safe'],
            [['impressions', 'promo_value', 'gross', 'net'], 'number'],
            [['provider_company', 'contact'], 'string', 'max' => 255],
            [['format', 'phone_email', 'comments'], 'string', 'max' => 800]
        ]);
    }
	
	public function beforeValidate()
   {
    if(empty($this->gross))
    {
       $this->gross = 0;
    }
   
    return parent::beforeValidate();
   }
}
