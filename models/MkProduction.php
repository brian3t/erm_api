<?php

namespace app\models;

use Yii;
use \app\models\base\MkProduction as BaseMkProduction;

/**
 * This is the model class for table "mk_production".
 */
class MkProduction extends BaseMkProduction
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return array_replace_recursive(parent::rules(),
	    [
            [['marketing_id', 'company_id'], 'required'],
            [['marketing_id', 'company_id'], 'integer'],
            [['created_at', 'updated_at'], 'safe'],
            [['gross', 'net'], 'number'],
            [['provider_company'], 'string', 'max' => 500],
            [['type', 'contact', 'phone_email'], 'string', 'max' => 255]
        ]);
    }
	
	public function beforeValidate(){
		if (empty($this->gross)){
			$this->gross = 0;
		}
		return parent::beforeValidate();
	}
}
