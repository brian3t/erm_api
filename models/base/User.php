<?php

namespace app\models\base;

use Yii;

/**
 * This is the base model class for table "user".
 *
 * @property integer $id
 * @property string $username
 * @property string $email
 * @property string $password_hash
 * @property string $auth_key
 * @property integer $confirmed_at
 * @property string $unconfirmed_email
 * @property integer $blocked_at
 * @property string $registration_ip
 * @property integer $created_at
 * @property integer $updated_at
 * @property integer $flags
 *
 * @property \app\models\CompanyUser $companyUser
 */
class User extends \yii\db\ActiveRecord
{
    use \mootensai\relation\RelationTrait;
    
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['username', 'email', 'password_hash', 'auth_key', 'created_at', 'updated_at'], 'required'],
            [['confirmed_at', 'blocked_at', 'created_at', 'updated_at', 'flags'], 'integer'],
            [['username', 'email', 'unconfirmed_email'], 'string', 'max' => 255],
            [['password_hash'], 'string', 'max' => 60],
            [['auth_key'], 'string', 'max' => 32],
            [['registration_ip'], 'string', 'max' => 45],
            [['email'], 'unique'],
            [['username'], 'unique'],
        ];
    }
    
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'user';
    }
    
    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'username' => 'Username',
            'email' => 'Email',
            'password_hash' => 'Password Hash',
            'auth_key' => 'Auth Key',
            'confirmed_at' => 'Confirmed At',
            'unconfirmed_email' => 'Unconfirmed Email',
            'blocked_at' => 'Blocked At',
            'registration_ip' => 'Registration Ip',
            'flags' => 'Flags',
        ];
    }
    
    // /**
    //  * @return \yii\db\ActiveQuery
    //  */
    // public function getCompanyUsers()
    // {
    //     return $this->hasMany(\app\models\CompanyUser::className(), ['user_id' => 'id'])->inverseOf('user');
    // }
    //
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCompanyUser()
    {
        return $this->hasOne(\app\models\CompanyUser::className(), ['user_id' => 'id'])->inverseOf('user');
    }
    
    public function getCompany()
    {
        return $this->companyUser?$this->companyUser->company:null;
    }
    
    
    public function fields()
    {
        $parent_fields = parent::fields();
        $parent_fields = array_diff($parent_fields,
            ['password_hash', 'registration_ip', 'unconfirmed_email', 'blocked_at', 'updated_at']);
        return array_merge($parent_fields, [
            'company' => function ($model) {
                return $model->company->attributes;
            },
        
        ]);
    }
    
}
