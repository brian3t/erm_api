<?php

namespace app\models\base;

use Yii;

/**
 * This is the base model class for table "company".
 *
 * @property integer $id
 * @property string $name
 * @property string $website
 * @property string $headline
 * @property string $industry
 * @property string $phone_number
 * @property string $city
 * @property string $state
 * @property string $postal_code
 * @property string $num_of_employee
 * @property integer $annual_revenue
 * @property integer $facebook_fans
 * @property string $twitter_handle
 * @property integer $twitter_followers
 * @property string $linkedin_company_page
 * @property string $timezone
 * @property string $description
 * @property string $line_of_business
 *
 * @property \app\models\User[] $users
 */
class Company extends \yii\db\ActiveRecord
{
    use \mootensai\relation\RelationTrait;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'description', 'line_of_business'], 'required'],
            [['annual_revenue', 'facebook_fans', 'twitter_followers'], 'integer'],
            [['timezone'], 'string'],
            [['name', 'website'], 'string', 'max' => 200],
            [['headline'], 'string', 'max' => 400],
            [['industry', 'twitter_handle', 'linkedin_company_page'], 'string', 'max' => 80],
            [['phone_number'], 'string', 'max' => 20],
            [['city'], 'string', 'max' => 60],
            [['state'], 'string', 'max' => 6],
            [['postal_code'], 'string', 'max' => 10],
            [['num_of_employee'], 'string', 'max' => 30],
            [['description', 'line_of_business'], 'string', 'max' => 800]
        ];
    }
    
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'company';
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
            'website' => 'Website',
            'headline' => 'Headline',
            'industry' => 'Industry',
            'phone_number' => 'Phone Number',
            'city' => 'City',
            'state' => 'State',
            'postal_code' => 'Postal Code',
            'num_of_employee' => 'Num Of Employee',
            'annual_revenue' => 'Annual Revenue',
            'facebook_fans' => 'Facebook Fans',
            'twitter_handle' => 'Twitter Handle',
            'twitter_followers' => 'Twitter Followers',
            'linkedin_company_page' => 'Linkedin Company Page',
            'timezone' => 'Timezone',
            'description' => 'Description',
            'line_of_business' => 'Line Of Business',
        ];
    }
    
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUsers()
    {
        return $this->hasMany(\app\models\User::className(), ['company_id' => 'id'])->inverseOf('company');
    }
    }
