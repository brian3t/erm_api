<?php

namespace app\models\base;

use yii;

/**
 * This is the base model class for table "mp".
 *
 * @property integer $id
 * @property string $name
 * @property string $end_point_name
 *
 * @property \app\models\InventoryMp $inventoryMp
 * @property \app\models\Order[] $orders
 */
class Mp extends \yii\db\ActiveRecord
{

    use \mootensai\relation\RelationTrait;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id'], 'required'],
            [['id'], 'integer'],
            [['name', 'end_point_name'], 'string', 'max' => 45]
        ];
    }
    
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'mp';
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
            'end_point_name' => 'End Point Name',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getInventoryMp()
    {
        return $this->hasOne(\app\models\InventoryMp::className(), ['mp_id' => 'id']);
    }

    public function getOrders()
    {
        return $this->hasMany(\app\models\Order::className(), ['mp_id' => 'id']);
    }

}
