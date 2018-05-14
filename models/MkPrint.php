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
            [['promo_value', 'monday', 'tuesday', 'wednesday', 'thursday', 'friday', 'saturday', 'sunday', 'gross', 'net'], 'number'],
            [['paid_run_from', 'paid_run_to', 'promo_run_from', 'promo_run_to'], 'safe'],
            [['provider_company', 'type', 'contact'], 'string', 'max' => 255],
            [['phone_email'], 'string', 'max' => 800],
            [['size'], 'string', 'max' => 80]
        ]);
    }
	
}
