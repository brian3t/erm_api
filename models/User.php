<?php

namespace app\models;

use Yii;
use \app\models\base\User as BaseUser;

/**
 * This is the model class for table "user".
 * Note: this is not being used for RAW USER
 */
class User extends BaseUser
{
//    private $_union_memberships;
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return parent::rules();
    }
    
    
    public function getName()
    {
        return $this->profile?$this->profile->name:$this->username;
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
