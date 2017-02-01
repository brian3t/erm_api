<?php

namespace app\models\base;

use Yii;
use yii\behaviors\TimestampBehavior;

/**
 * This is the base model class for table "venue".
 *
 * @property integer $id
 * @property string $name
 * @property string $venue_type
 * @property string $created_at
 * @property string $updated_at
 * @property string $previous_name
 * @property string $note
 * @property string $ticket_rebate
 * @property string $other_deal
 * @property string $address1
 * @property string $address2
 * @property string $city
 * @property string $state
 * @property string $zipcode
 * @property string $country
 * @property string $timezone
 * @property string $owner
 * @property integer $company_id
 * @property string $general_info_email
 * @property string $main_office_phone
 * @property string $box_office_phone
 * @property string $fax_phone
 * @property string $other_phone
 * @property integer $primary_ticketing_company_id
 * @property integer $other_seating_capacity
 * @property integer $end_stage_seating_capacity
 * @property integer $full_stage_seating_capacity
 * @property integer $half_stage_seating_capacity
 * @property integer $in_the_round_seating_capacity
 * @property string $other_seating_capacity_name
 * @property integer $other_seating_capacity_value
 * @property string $webpage
 * @property string $facebook
 * @property string $yahoo
 * @property string $linkedin
 * @property string $twitter
 * @property string $instagram
 * @property string $google
 *
 * @property \app\models\Offer[] $offers
 * @property \app\models\Settlement[] $settlements
 * @property \app\models\Company $company
 * @property \app\models\Company $primaryTicketingCompany
 */
class Venue extends \yii\db\ActiveRecord
{
    use \mootensai\relation\RelationTrait;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name'], 'required'],
            [['venue_type', 'timezone'], 'string'],
            [['created_at', 'updated_at'], 'safe'],
            [['company_id', 'primary_ticketing_company_id', 'other_seating_capacity', 'end_stage_seating_capacity', 'full_stage_seating_capacity', 'half_stage_seating_capacity', 'in_the_round_seating_capacity', 'other_seating_capacity_value'], 'integer'],
            [['name', 'previous_name', 'city', 'other_seating_capacity_name'], 'string', 'max' => 255],
            [['note', 'address1'], 'string', 'max' => 2000],
            [['ticket_rebate', 'other_deal'], 'string', 'max' => 8000],
            [['address2', 'owner', 'webpage', 'facebook', 'yahoo', 'linkedin', 'twitter', 'instagram', 'google'], 'string', 'max' => 800],
            [['state'], 'string', 'max' => 8],
            [['zipcode'], 'string', 'max' => 20],
            [['country', 'general_info_email'], 'string', 'max' => 80],
            [['main_office_phone', 'box_office_phone', 'fax_phone', 'other_phone'], 'string', 'max' => 25]
        ];
    }
    
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'venue';
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
            'venue_type' => 'Venue Type',
            'previous_name' => 'Previous Name',
            'note' => 'Note',
            'ticket_rebate' => 'Ticket Rebate',
            'other_deal' => 'Other Deal',
            'address1' => 'Address1',
            'address2' => 'Address2',
            'city' => 'City',
            'state' => 'State',
            'zipcode' => 'Zipcode',
            'country' => 'Country',
            'timezone' => 'Timezone',
            'owner' => 'Owner',
            'company_id' => 'Organizer',
            'general_info_email' => 'General Info Email',
            'main_office_phone' => 'Main Office Phone',
            'box_office_phone' => 'Box Office Phone',
            'fax_phone' => 'Fax Phone',
            'other_phone' => 'Other Phone',
            'primary_ticketing_company_id' => 'Primary Ticketing Company',
            'other_seating_capacity' => 'Other Seating Capacity',
            'end_stage_seating_capacity' => 'End Stage Seating Capacity',
            'full_stage_seating_capacity' => 'Full Stage Seating Capacity',
            'half_stage_seating_capacity' => 'Half Stage Seating Capacity',
            'in_the_round_seating_capacity' => 'In The Round Seating Capacity',
            'other_seating_capacity_name' => 'Other Seating Capacity Name',
            'other_seating_capacity_value' => 'Other Seating Capacity Value',
            'webpage' => 'Webpage',
            'facebook' => 'Facebook',
            'yahoo' => 'Yahoo',
            'linkedin' => 'Linkedin',
            'twitter' => 'Twitter',
            'instagram' => 'Instagram',
            'google' => 'Google',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getOffers()
    {
        return $this->hasMany(\app\models\Offer::className(), ['venue_id' => 'id'])->inverseOf('coproVenue')->inverseOf('venue');
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSettlements()
    {
        return $this->hasMany(\app\models\Settlement::className(), ['second_party_venue_id' => 'id'])->inverseOf('secondPartyVenue');
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCompany()
    {
        return $this->hasOne(\app\models\Company::className(), ['id' => 'company_id'])->inverseOf('venues');
    }
    
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPrimaryTicketingCompany()
    {
        return $this->hasOne(\app\models\Company::className(), ['id' => 'primary_ticketing_company_id'])->inverseOf('ticketVenues');
    }
    
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getOrganizer()
    {
        return $this->hasOne(\app\models\Company::className(), ['id' => 'company_id'])->inverseOf('venues');
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
                'value' => new \yii\db\Expression('NOW()'),
            ],
        ];
    }
}
