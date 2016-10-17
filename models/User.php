<?php

namespace app\models;

use Yii;
use \app\models\base\User as BaseUser;

/**
 * This is the model class for table "user".
 */
class User extends BaseUser
{
//    private $_union_memberships;
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return array_replace_recursive(parent::rules(),
	    [
            [['username', 'email', 'password_hash', 'auth_key', 'created_at', 'updated_at', 'first_name', 'line_of_business', 'union_memberships'], 'required'],
            [['company_id', 'confirmed_at', 'blocked_at', 'created_at', 'updated_at', 'flags'], 'integer'],
            [['line_of_business', 'phone_number_type'], 'string'],
            [['birthdate'], 'safe'],
            [['username', 'email', 'unconfirmed_email'], 'string', 'max' => 255],
            [['password_hash'], 'string', 'max' => 60],
            [['auth_key'], 'string', 'max' => 32],
            [['registration_ip'], 'string', 'max' => 45],
            [['first_name', 'last_name', 'twitter_id', 'facebook_id', 'instagram_id', 'google_id', 'yahoo_id', 'linkedin_id'], 'string', 'max' => 80],
            [['job_title'], 'string', 'max' => 100],
            [['phone_number'], 'string', 'max' => 20],
            [['website_url'], 'string', 'max' => 400],
            [['email'], 'unique'],
            [['username'], 'unique']
        ]);
    }
    
    
    public function getName()
    {
        return $this->profile->name;
    }

    public function getUnionMemberships(){
        return explode(',', $this->union_memberships);
    }

//    public function setUnionMemberships($new_union_memberships)
//    {
//        $this->_union_memberships=json_encode($new_union_memberships);
//    }
    
    public function fields()
    {
        $parent_fields = parent::fields();
        $parent_fields = array_diff($parent_fields,
            ['password_hash', 'registration_ip', 'unconfirmed_email', 'blocked_at', 'updated_at']);
        return array_merge($parent_fields, [
            'name',
            'company' => function ($model) {
                return is_object($model->company) ? $model->company->attributes : ['name' => ''];
            },
            'profile' => function ($model) {
                return $model->profile->attributes;
            },
            'union_memberships' => function(){
                return $this->getUnionMemberships();
            }
        
        ]);
    }
    
}
