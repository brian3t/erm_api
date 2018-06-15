<?php

namespace app\models;

use Yii;
use \app\models\base\MkPrint as BaseMkPrint;

/**
 * This is the model class for table "mk_print".
 */
class MkPrint extends BaseMkPrint
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
            [['created_at', 'updated_at', 'paid_run_from', 'paid_run_to', 'promo_run_from', 'promo_run_to'], 'safe'],
            [['promo_value', 'monday', 'tuesday', 'wednesday', 'thursday', 'friday', 'saturday', 'sunday', 'gross', 'net'], 'number'],
            [['print_media', 'type', 'contact'], 'string', 'max' => 255],
            [['phone_email'], 'string', 'max' => 800],
            [['size'], 'string', 'max' => 80]
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
