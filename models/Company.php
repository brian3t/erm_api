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
            [['name', 'description', 'line_of_business', 'timezone'], 'required'],
            [['annual_revenue', 'facebook_fans', 'twitter_followers'], 'integer'],
            [['timezone'], 'string'],
            [['name', 'website'], 'string', 'max' => 200],
            [['headline'], 'string', 'max' => 400],
            [['industry', 'twitter_handle', 'linkedin_company_page'], 'string', 'max' => 80],
            [['phone_number'], 'string', 'max' => 20],
            [['address1', 'address2'], 'string', 'max' => 255],
            [['city'], 'string', 'max' => 60],
            [['state'], 'string', 'max' => 6],
            [['postal_code'], 'string', 'max' => 10],
            [['num_of_employee'], 'string', 'max' => 30],
            [['description', 'line_of_business'], 'string', 'max' => 800]
        ]);
    }
    
    // public function getCompanyUsersFullInfo(){
    //     $query= $this->hasMany(User::className(), ['id' => 'user_id'])->viaTable('company_user', ['company_id'=>'id'])
    //         ->joinWith('profile')
    //         ->addSelect(['*', "profile.name AS name"]);
    //     return $query->asArray();
    // }

    // public function fields()
    // {
    //
    //     $parent_fields = parent::fields();
    //     unset($parent_fields['user']);
    //     return array_merge($parent_fields, ['user'=>function($model){
    //         $user_full = $model->companyUsersFullInfo;
    //         foreach ($user_full as $index=>$company){
    //             unset($user_full[$index]['profile']);
    //         }
    //         return $user_full;
    //     }]);
    // }
}
