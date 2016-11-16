<?php

namespace app\models;

use \app\models\base\Venue as BaseVenue;

/**
 * This is the model class for table "venue".
 */
class Venue extends BaseVenue
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return array_replace_recursive(parent::rules(),
	    [
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
        ]);
    }
	
}
