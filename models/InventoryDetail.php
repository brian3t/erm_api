<?php

namespace app\models;

use Yii;
use \app\models\base\InventoryDetail as BaseInventoryDetail;

/**
 * This is the model class for table "inventory_detail".
 */
class InventoryDetail extends BaseInventoryDetail
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return array_replace_recursive(parent::rules(),
	    [
            [['quantity_type'], 'string'],
            [['inventory_id'], 'required'],
            [['inventory_id', 'available_quantity', 'total_quantity'], 'integer'],
            [['estimated_availability_date'], 'safe'],
            [['vendor_name', 'facility_name'], 'string', 'max' => 200],
            [['po'], 'string', 'max' => 80],
            [['po_destination'], 'string', 'max' => 400],
            [['inventory_id'], 'unique']
        ]);
    }
	
}
