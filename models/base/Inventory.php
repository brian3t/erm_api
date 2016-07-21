<?php

namespace app\models\base;

use Yii;
use yii\behaviors\TimestampBehavior;

/**
 * This is the base model class for table "inventory".
 *
 * @property integer $id
 * @property string $sku
 * @property integer $quantity_available
 * @property string $updatetime
 *
 * @property \app\models\InventoryDetail[] $inventoryDetails
 */
class Inventory extends \yii\db\ActiveRecord
{

    use \mootensai\relation\RelationTrait;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['sku'], 'required'],
            [['quantity_available'], 'integer'],
            [['updatetime'], 'safe'],
            [['sku'], 'string', 'max' => 50],
            [['sku'], 'unique']
        ];
    }
    
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'inventory';
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'sku' => 'Sku',
            'quantity_available' => 'Quantity Available',
            'updatetime' => 'Updatetime',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getInventoryDetails()
    {
        return $this->hasMany(\app\models\InventoryDetail::className(), ['inventory_id' => 'id']);
    }

/**
     * @inheritdoc
     * @return type mixed
     */ 
    public function behaviors()
    {
        return [
            [
                'class' => TimestampBehavior::className(),
                'createdAtAttribute' => false,
                'updatedAtAttribute' => 'updatetime',
                'value' => new \yii\db\Expression('NOW()'),
            ],
        ];
    }

    /**
     * @inheritdoc
     * @return \app\models\InventoryQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \app\models\InventoryQuery(get_called_class());
    }
}
