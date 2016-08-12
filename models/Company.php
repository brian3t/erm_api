<?php

namespace app\models;

use Yii;
use \app\models\base\Company as BaseCompany;

/**
 * This is the model class for table "company".
 */
class Company extends BaseCompany
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return array_replace_recursive(parent::rules(),
	    [
            [['name', 'description', 'line_of_business'], 'required'],
            [['annual_revenue', 'facebook_fans', 'twitter_followers'], 'integer'],
            [['timezone'], 'string'],
            [['name', 'website'], 'string', 'max' => 200],
            [['headline'], 'string', 'max' => 400],
            [['industry', 'twiiter_handle', 'linkedin_company_page'], 'string', 'max' => 80],
            [['phone_number'], 'string', 'max' => 20],
            [['city'], 'string', 'max' => 60],
            [['state'], 'string', 'max' => 6],
            [['postal_code'], 'string', 'max' => 10],
            [['num_of_employee'], 'string', 'max' => 30],
            [['description', 'line_of_business'], 'string', 'max' => 800]
        ]);
    }
	
}