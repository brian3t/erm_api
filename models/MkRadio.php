<?php

namespace app\models;

use Yii;
use \app\models\base\MkRadio as BaseMkRadio;

/**
 * This is the model class for table "mk_radio".
 */
class MkRadio extends BaseMkRadio
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return array_replace_recursive(parent::rules(),
            [
                [['marketing_id', 'company_id'], 'required'],
                [['marketing_id', 'company_id', 'promo_mentions', 'promo_tickets', 'paid_spots'], 'integer'],
                [['created_at', 'updated_at', 'promo_run_from', 'promo_run_to', 'paid_run_from', 'paid_run_to'], 'safe'],
                [['promo_value', 'gross', 'net'], 'number'],
                [['station', 'format'], 'string', 'max' => 800],
                [['contact', 'contact_phone_email', 'thirty', 'sixty'], 'string', 'max' => 255]
            ]);
    }

    public function beforeValidate()
    {
        return parent::beforeValidate();
    }

    /**
     * Simulate db auto value of gross and net. Problem is, after save() is called on model, model doesn't get database default values into it yet
     * @param bool $insert
     * @param array $changedAttributes
     */
    public function afterSave($insert, $changedAttributes)
    {
        if (empty($this->gross)) {
            $this->gross = 0;
        }
        if (empty($this->net)) {
            $this->net = 0;
        }
        return parent::afterSave($insert, $changedAttributes);
    }
}
