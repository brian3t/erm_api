<?php

namespace app\models;

use Yii;
use \app\models\base\MkRadio as BaseMkRadio;

/**
 * This is the model class for table "mk_radio".
 */
class MkRadio extends BaseMkRadio
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return array_replace_recursive(parent::rules(),
	    [
            [['marketing_id', 'company_id'], 'required'],
            [['marketing_id', 'company_id', 'promo_mentions', 'promo_tickets', 'paid_spots'], 'integer'],
            [['created_at', 'updated_at', 'promo_run_from', 'promo_run_to', 'paid_run_from', 'paid_run_to'], 'safe'],
            [['promo_value', 'gross', 'net'], 'number'],
            [['station', 'format'], 'string', 'max' => 800],
            [['contact', 'contact_phone_email', 'thirty', 'sixty'], 'string', 'max' => 255]
        ]);
    }
	
	public function beforeValidate(){
		if (empty($this->gross)){
			$this->gross = 0;
		}
		return parent::beforeValidate();
	}

	/*public function beforeSave($insert){
        if ($insert){
            var_dump($this->id);
        }
        return parent::beforeSave($insert);
    }*/
}
