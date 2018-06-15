<?php

namespace app\models;

use Yii;
use \app\models\base\MkTelevision as BaseMkTelevision;

/**
 * This is the model class for table "mk_television".
 */
class MkTelevision extends BaseMkTelevision
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return array_replace_recursive(parent::rules(),
	    [
            [['marketing_id', 'company_id'], 'required'],
            [['marketing_id', 'company_id', 'promo_tickets', 'qty'], 'integer'],
            [['created_at', 'updated_at', 'promo_run_from', 'promo_run_to', 'paid_run_from', 'paid_run_to'], 'safe'],
            [['impressions', 'promo_value', 'gross', 'net'], 'number'],
            [['tv_company', 'contact', 'dg_code'], 'string', 'max' => 255],
            [['format', 'phone_email'], 'string', 'max' => 800]
        ]);
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
