<?php

namespace app\models;

use \app\models\base\Venue as BaseVenue;

/**
 * This is the model class for table "venue".
 */
class Venue extends BaseVenue
{
    public static $order_by_col='name';
}
