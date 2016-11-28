<?php

namespace app\models;

use \app\models\base\Offer as BaseOffer;

/**
 * This is the model class for table "offer".
 */
class Offer extends BaseOffer
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return array_replace_recursive(parent::rules(),
	    [
            [['user_id', 'event_id'], 'required'],
            [['user_id', 'copro_promoter_id', 'copro_venue_id', 'show_number', 'show_total_num', 'agency_id', 'agent_id', 'artist_id', 'venue_id', 'is_tbd_date', 'l1_gross_ticket', 'l1_kill', 'l2_gross_ticket', 'l2_kill', 'l3_gross_ticket', 'l3_kill', 'l4_gross_ticket', 'l4_kill', 'l5_gross_ticket', 'l5_kill', 'is_on_sale_date_tbd', 'ticketing_company_id', 'is_artist_production_buyout', 'pre_show_lockout', 'post_show_lockout', 'support_artist_1_id', 'support_artist_2_id', 'support_artist_3_id', 'artist_comp', 'production_comp', 'promotional_comp', 'house_comp', 'kill'], 'integer'],
            [['offer_type', 'status', 'show_type', 'artist_offer_type', 'expense_application', 'radius_clause_metric', 'pre_show_lockout_unit', 'post_show_lockout_unit'], 'string'],
            [['created_on', 'updated_on', 'show_date', 'doors', 'showtime', 'on_sale_date'], 'safe'],
            [['l1_price', 'l2_price', 'l3_price', 'l4_price', 'l5_price', 'tax', 'tax_per_ticket', 'facility_fee', 'artist_guarantee', 'artist_deposit', 'artist_split', 'promoter_profit', 'radius_clause', 'support_artist_1_total', 'support_artist_2_total', 'support_artist_3_total', 'housenut_total', 'merch_buyout_venue_sell', 'merch_buyout_artist_sell', 'merch_artist_split_venue_sell', 'merch_artist_split_artist_sell', 'merch_artist_split_media_venue_sell', 'merch_artist_split_media_artist_sell'], 'number'],
            [['event_id'], 'string', 'max' => 45],
            [['notes'], 'string', 'max' => 2000],
            [['seating_plan'], 'string', 'max' => 80],
            [['tax_note', 'facility_fee_note', 'sponsorship'], 'string', 'max' => 255],
            [['artist_deal_note', 'housenut_expense', 'general_expense_note', 'merch_note'], 'string', 'max' => 3000],
            [['general_expense', 'production_expense', 'variable_expense'], 'string', 'max' => 8000],
            [['artist_comp_note', 'production_comp_note', 'promotional_comp_note', 'house_comp_note', 'kill_note', 'comp_kill_note'], 'string', 'max' => 800]
        ]);
    }
    
    public function attributeLabels()
    {
        $labels = parent::attributeLabels();
        $labels = array_replace_recursive($labels, [
            'user_id' => 'Booked By',
            'is_on_sale_date_tbd' => 'On Sale Date TBD',
            'copro_venue_id' => 'Copro Venue',
            'venue_id' => 'Venue',
            'is_tbd_date' => 'Show Date is TBD',
            'is_artist_production_buyout'=>'Artist Production Buyout',
            'support_artist_1_id' => 'Support Artist 1',
            'support_artist_2_id' => 'Support Artist 2',
            'support_artist_3_id' => 'Support Artist 3',
            'merch_note' => 'Merchandise Note',
        ]);
        return $labels;
    }
    
}
