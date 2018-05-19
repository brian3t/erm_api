<?php

namespace app\models;

use Yii;
use \app\models\base\Marketing as BaseMarketing;

/**
 * This is the model class for table "marketing".
 */
class Marketing extends BaseMarketing
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return array_replace_recursive(parent::rules(),
	    [
            [['offer_id', 'user_id'], 'required'],
            [['offer_id', 'user_id'], 'integer'],
            [['created_at', 'updated_at'], 'safe'],
            [['budget'], 'number'],
            [['note'], 'string', 'max' => 2000],
            [['offer_id'], 'unique']
        ]);
    }
	
}
