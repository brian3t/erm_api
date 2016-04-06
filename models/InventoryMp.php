<?php

namespace app\models;

use Yii;
use \app\models\base\InventoryMp as BaseInventoryMp;

/**
 * This is the model class for table "inventory_mp".
 */
class InventoryMp extends BaseInventoryMp
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return array_replace_recursive(parent::rules(),
	    [
            [['mp_id'], 'required'],
            [['mp_id'], 'integer'],
            [['sku'], 'string', 'max' => 45],
            [['mp_id', 'sku'], 'unique', 'targetAttribute' => ['mp_id', 'sku'], 'message' => 'The combination of Mp ID and Sku has already been taken.']
        ]);
    }
	
}
