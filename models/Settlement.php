<?php

namespace app\models;

use \app\models\base\Settlement as BaseSettlement;

/**
 * This is the model class for table "settlement".
 */
class Settlement extends BaseSettlement
{
    public static $order_by_col='settlement_id';
    /**
     * @inheritdoc
     */
//    public function rules()
//    {
//        return array_replace_recursive(parent::rules(),
//	    [
//            [['settlement_id'], 'required'],
//            [['created_at', 'updated_at', 'second_party_date'], 'safe'],
//            [['first_party_id', 'first_party_event_id', 'first_party_capacity', 'second_party_event_id', 'second_party_capacity', 'second_party_artist_id', 'second_party_venue_id'], 'integer'],
//            [['artist_walkout_final', 'ad_plan_final', 'promoter_revenue_final', 'ticket_sales_final'], 'number'],
//            [['settlement_id'], 'string', 'max' => 45],
//            [['note'], 'string', 'max' => 8000],
//            [['settlement_id'], 'unique']
//        ]);
//    }
	
}
