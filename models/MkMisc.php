<?php

namespace app\models;

use Yii;
use \app\models\base\MkMisc as BaseMkMisc;

/**
 * This is the model class for table "mk_misc".
 */
class MkMisc extends BaseMkMisc
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
            [['provider_company'], 'string', 'max' => 255],
            [['description'], 'string', 'max' => 2000]
        ]);
    }
	
	public function beforeValidate(){
		if (empty($this->gross)){
			$this->gross = 0;
		}
		return parent::beforeValidate();
	}
}
