<?php

namespace app\models;

use Yii;
use \app\models\base\User as BaseUser;

/**
 * This is the model class for table "user".
 * Note: this is not being used for RAW USER
 */
class User extends BaseUser {
//    private $_union_memberships;
    /**
     * @inheritdoc
     */
    public function rules() {
        return parent::rules();
    }


    public function getName() {
        return $this->profile ? $this->profile->name : $this->username;
    }

    public function getUnionMemberships() {
        return explode(',', $this->union_memberships);
    }

//    public function setUnionMemberships($new_union_memberships)
//    {
//        $this->_union_memberships=json_encode($new_union_memberships);
//    }

    public function fields() {
        $parent_fields = parent::fields();
        $parent_fields = array_diff($parent_fields,
            ['password_hash', 'registration_ip', 'unconfirmed_email', 'blocked_at', 'updated_at']);
        return array_merge($parent_fields, [
            'name',
            'company' => function ($model) {
                return is_object($model->company) ? $model->company->attributes : ['name' => ''];
            },
            'profile' => function ($model) {
                return $model->profile ? $model->profile->attributes : null;
            },
            'union_memberships' => function () {
                return $this->getUnionMemberships();
            },
            'offer' => function ($model) {
                if(!is_object($model->offers) && !is_array($model->offers)) {
                    return null;
                };
                $result = [];
                $offer_ids = array_map(function ($v) {
                    return $v->id;
                }, $model->offers);
                return $offer_ids;
            }

        ]);
    }

    public function beforeValidate() {
        if(is_int($this->created_at)) {

        }
        if(is_array($this->union_memberships)) {
            $this->union_memberships = implode(',', $this->union_memberships);
        }
        return parent::beforeValidate();
    }

}
