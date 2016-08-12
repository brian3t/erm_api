<?php

namespace app\models;

use Yii;
use \app\models\base\CompanyUser as BaseCompanyUser;

/**
 * This is the model class for table "company_user".
 */
class CompanyUser extends BaseCompanyUser
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return array_replace_recursive(parent::rules(),
	    [
            [['company_id', 'user_id'], 'required'],
            [['company_id', 'user_id'], 'integer'],
            [['role'], 'string'],
            [['company_id', 'user_id'], 'unique', 'targetAttribute' => ['company_id', 'user_id'], 'message' => 'The combination of Company ID and User ID has already been taken.']
        ]);
    }
	
}
