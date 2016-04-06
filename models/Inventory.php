<?php

namespace app\models;

use Yii;
use \app\models\base\Inventory as BaseInventory;

/**
 * This is the model class for table "inventory".
 */
class Inventory extends BaseInventory
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return array_replace_recursive(parent::rules(),
	    [
            [['sku'], 'required'],
            [['quantity'], 'integer'],
            [['updatetime'], 'safe'],
            [['sku'], 'string', 'max' => 50]
        ]);
    }
	
}
