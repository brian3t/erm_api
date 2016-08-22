<?php

namespace app\models\base;

use Yii;

/**
 * This is the base model class for table "user".
 *
 * @property integer $id
 * @property string $username
 * @property integer $company_id
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
 * @property string $first_name
 * @property string $last_name
 * @property string $job_title
 * @property string $line_of_business
 * @property string $union_memberships
 * @property string $phone_number_type
 * @property string $phone_number
 * @property string $birthdate
 * @property string $website_url
 * @property string $twitter_id
 * @property string $facebook_id
 * @property string $instagram_id
 * @property string $google_id
 * @property string $yahoo_id
 * @property string $linkedin_id
 *
 * @property \app\models\Profile $profile
 * @property \app\models\SocialAccount[] $socialAccounts
 * @property \app\models\Token[] $tokens
 * @property \app\models\Company $company
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
            [['username', 'email', 'password_hash', 'auth_key', 'created_at', 'updated_at', 'first_name', 'line_of_business', 'union_memberships'], 'required'],
            [['company_id', 'confirmed_at', 'blocked_at', 'created_at', 'updated_at', 'flags'], 'integer'],
            [['line_of_business', 'union_memberships', 'phone_number_type'], 'string'],
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
            'company_id' => 'Company ID',
            'email' => 'Email',
            'password_hash' => 'Password Hash',
            'auth_key' => 'Auth Key',
            'confirmed_at' => 'Confirmed At',
            'unconfirmed_email' => 'Unconfirmed Email',
            'blocked_at' => 'Blocked At',
            'registration_ip' => 'Registration Ip',
            'flags' => 'Flags',
            'first_name' => 'First Name',
            'last_name' => 'Last Name',
            'job_title' => 'Job Title',
            'line_of_business' => 'Line Of Business',
            'union_memberships' => 'Union Memberships',
            'phone_number_type' => 'Phone Number Type',
            'phone_number' => 'Phone Number',
            'birthdate' => 'Birthdate',
            'website_url' => 'Website Url',
            'twitter_id' => 'Twitter ID',
            'facebook_id' => 'Facebook ID',
            'instagram_id' => 'Instagram ID',
            'google_id' => 'Google ID',
            'yahoo_id' => 'Yahoo ID',
            'linkedin_id' => 'Linkedin ID',
        ];
    }
    
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProfile()
    {
        return $this->hasOne(\app\models\Profile::className(), ['user_id' => 'id'])->inverseOf('user');
    }
        
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSocialAccounts()
    {
        return $this->hasMany(\app\models\SocialAccount::className(), ['user_id' => 'id'])->inverseOf('user');
    }
        
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTokens()
    {
        return $this->hasMany(\app\models\Token::className(), ['user_id' => 'id'])->inverseOf('user');
    }
        
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCompany()
    {
        return $this->hasOne(\app\models\Company::className(), ['id' => 'company_id'])->inverseOf('users');
    }
    }
