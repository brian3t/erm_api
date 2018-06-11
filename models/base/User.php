<?php

namespace app\models\base;

use Yii;
use yii\behaviors\TimestampBehavior;

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
 * @property string $note
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
 * @property string $work_phone
 * @property string $mobile_phone
 * @property string $home_phone
 * @property string $address1
 * @property string $address2
 * @property string $city
 * @property string $state
 * @property string $zipcode
 * @property string $country
 * @property integer $belong_company_id
 *
 * @property \app\models\Marketing[] $marketings 
 * @property \app\models\Offer[] $offers
 * @property \app\models\Profile $profile
 * @property \app\models\Settlement[] $settlements
 * @property \app\models\SocialAccount[] $socialAccounts
 * @property \app\models\Token[] $tokens
 * @property \app\models\Company $belongCompany
 * @property \app\models\Company $company
 */
class User extends \yii\db\ActiveRecord
{
    use \mootensai\relation\RelationTrait;
    
	/**
	   * This function helps \mootensai\relation\RelationTrait runs faster
	   * @return array relation names of this model
	   */
	   public function relationNames()
	   {
		   return [
			   'marketings',
			   'offers',
			   'profile',
			   'settlements',
			   'socialAccounts',
			   'tokens',
			   'belongCompany',
			   'company'
		   ];
	   }

   /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['username'], 'required'],
            [['company_id', 'confirmed_at', 'blocked_at', 'created_at', 'updated_at', 'flags', 'last_login_at', 'belong_company_id'], 'integer'],
            [['created_at', 'updated_at', 'birthdate'], 'safe'],
            [['line_of_business', 'phone_number_type'], 'string'],
            [['birthdate'], 'safe'],
            [['username', 'email', 'unconfirmed_email', 'city'], 'string', 'max' => 255],
            [['password_hash'], 'string', 'max' => 60],
            [['auth_key'], 'string', 'max' => 32],
            [['registration_ip'], 'string', 'max' => 45],
            [['first_name', 'last_name', 'twitter_id', 'facebook_id', 'instagram_id', 'google_id', 'yahoo_id', 'linkedin_id', 'state', 'country'], 'string', 'max' => 80],
            [['job_title'], 'string', 'max' => 100],
            [['union_memberships', 'address2'], 'string', 'max' => 800],
            [['note', 'address1'], 'string', 'max' => 2000],
            [['phone_number', 'work_phone', 'mobile_phone', 'home_phone', 'zipcode'], 'string', 'max' => 20],
            [['website_url'], 'string', 'max' => 400],
            [['state'], 'string', 'max' => 80],
            [['country'], 'string', 'max' => 80],
            [['username'], 'unique'],
            [['email'], 'unique']
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
            'note' => 'Note',
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
            'work_phone' => 'Work Phone',
            'mobile_phone' => 'Mobile Phone',
            'home_phone' => 'Home Phone',
            'address1' => 'Address 1',
            'address2' => 'Address 2',
            'city' => 'City',
            'state' => 'State',
            'zipcode' => 'Zip/Postal code',
            'country' => 'Country/Region',
            'belong_company_id' => 'Belongs to Company',
        ];
    }

    /**
    * @return \yii\db\ActiveQuery
    */
   public function getMarketings()
   {
       return $this->hasMany(\app\models\Marketing::className(), ['user_id' => 'id'])->inverseOf('user');
   }
       
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getOffers()
    {
        return $this->hasMany(\app\models\Offer::className(), ['user_id' => 'id'])->inverseOf('user');
//        return $this->hasMany(\app\models\Offer::className(), ['support_artist_3_id' => 'id'])->inverseOf('user')->inverseOf('agent')->inverseOf('artist')->inverseOf('supportArtist1')->inverseOf('supportArtist2')->inverseOf('supportArtist3');
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
    public function getSettlements()
    {
        return $this->hasMany(\app\models\Settlement::className(), ['second_party_artist_id' => 'id'])->inverseOf('secondPartyArtist');
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

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBelongCompany()
    {
        return $this->hasOne(\app\models\Company::className(), ['id' => 'belong_company_id'])->inverseOf('usersBelongToThis');
    }

    /**
     * @inheritdoc
     * @return array mixed
     */
    public function behaviors()
    {
        return [
            'timestamp' => [
                'class' => TimestampBehavior::className(),
                'createdAtAttribute' => 'created_at',
                'updatedAtAttribute' => 'updated_at',
                'value' => new \yii\db\Expression('UNIX_TIMESTAMP()'),
            ],
        ];
    }
    
    public function beforeSave($insert)
    {
        if (empty($this->line_of_business)) {
            $this->line_of_business = null;
        }
        return parent::beforeSave($insert); // TODO: Change the autogenerated stub
    }
    
}
