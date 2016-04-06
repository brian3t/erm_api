<?php

namespace app\models;

/**
 * This is the ActiveQuery class for [[InventoryMp]].
 *
 * @see InventoryMp
 */
class InventoryMpQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        $this->andWhere('[[status]]=1');
        return $this;
    }*/

    /**
     * @inheritdoc
     * @return InventoryMp[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return InventoryMp|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}