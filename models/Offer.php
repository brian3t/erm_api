<?php

namespace app\models;

use \app\models\base\Offer as BaseOffer;

/**
 * This is the model class for table "offer".
 */
class Offer extends BaseOffer
{
    public static $order_by_col = 'event_id';

    public function attributeLabels()
    {
        $labels = parent::attributeLabels();
        $labels = array_replace_recursive($labels, [
            'user_id' => 'Booked By',
            'is_on_sale_date_tbd' => 'On Sale Date TBD',
            'copro_venue_id' => 'Copro Venue',
            'venue_id' => 'Venue',
            'is_tbd_date' => 'Show Date is TBD',
            'is_artist_production_buyout' => 'Artist Production Buyout',
            'support_artist_1_id' => 'Support Artist 1',
            'support_artist_2_id' => 'Support Artist 2',
            'support_artist_3_id' => 'Support Artist 3',
            'merch_note' => 'Merchandise Note',
        ]);
        return $labels;
    }

    public function beforeSave($insert)
    {
        if (empty($this->expense_application)) {
            $this->expense_application = '';
        }
        return parent::beforeSave($insert);
    }

    public function beforeValidate()
    {
        $this->event_id = strval($this->event_id);
        return parent::beforeValidate();
    }
}
