<?php

namespace app\models;

use Yii;
use \app\models\base\Event as BaseEvent;

/**
 * This is the model class for table "event".
 */
class Event extends BaseEvent
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return array_replace_recursive(parent::rules(),
	    [
            [['action'], 'required'],
            [['action'], 'string'],
            [['mp_id'], 'integer'],
            [['start', 'stop'], 'safe'],
            [['note'], 'string', 'max' => 2550]
        ]);
    }
	
}
