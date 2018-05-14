<?php

namespace app\models\base;

use Yii;

/**
 * This is the base model class for table "mk_print".
 *
 * @property integer $id
 * @property integer $marketing_id
 * @property integer $company_id
 * @property string $provider_company
 * @property string $type
 * @property string $contact
 * @property string $phone_email
 * @property string $size
 * @property integer $promo_tickets
 * @property string $promo_value
 * @property string $paid_run_from
 * @property string $paid_run_to
 * @property string $promo_run_from
 * @property string $promo_run_to
 * @property integer $qty
 * @property string $monday
 * @property string $tuesday
 * @property string $wednesday
 * @property string $thursday
 * @property string $friday
 * @property string $saturday
 * @property string $sunday
 * @property string $gross
 * @property string $net
 *
 * @property \app\models\Marketing $marketing
 * @property \app\models\Company $company
 */
class MkPrint extends \yii\db\ActiveRecord
{
    use \mootensai\relation\RelationTrait;


    /**
    * This function helps \mootensai\relation\RelationTrait runs faster
    * @return array relation names of this model
    */
    public function relationNames()
    {
        return [
            'marketing',
            'company'
        ];
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['marketing_id', 'company_id'], 'required'],
            [['marketing_id', 'company_id', 'promo_tickets', 'qty'], 'integer'],
            [['promo_value', 'monday', 'tuesday', 'wednesday', 'thursday', 'friday', 'saturday', 'sunday', 'gross', 'net'], 'number'],
            [['paid_run_from', 'paid_run_to', 'promo_run_from', 'promo_run_to'], 'safe'],
            [['provider_company', 'type', 'contact'], 'string', 'max' => 255],
            [['phone_email'], 'string', 'max' => 800],
            [['size'], 'string', 'max' => 80]
        ];
    }

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'mk_print';
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'marketing_id' => 'Marketing ID',
            'company_id' => 'Company ID',
            'provider_company' => 'Provider Company',
            'type' => 'Type',
            'contact' => 'Contact',
            'phone_email' => 'Phone Email',
            'size' => 'Size',
            'promo_tickets' => 'Promo Tickets',
            'promo_value' => 'Promo Value',
            'paid_run_from' => 'Paid Run From',
            'paid_run_to' => 'Paid Run To',
            'promo_run_from' => 'Promo Run From',
            'promo_run_to' => 'Promo Run To',
            'qty' => 'Qty',
            'monday' => 'Monday',
            'tuesday' => 'Tuesday',
            'wednesday' => 'Wednesday',
            'thursday' => 'Thursday',
            'friday' => 'Friday',
            'saturday' => 'Saturday',
            'sunday' => 'Sunday',
            'gross' => 'Gross',
            'net' => 'Net',
        ];
    }
    
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMarketing()
    {
        return $this->hasOne(\app\models\Marketing::className(), ['id' => 'marketing_id'])->inverseOf('mkPrints');
    }
        
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCompany()
    {
        return $this->hasOne(\app\models\Company::className(), ['id' => 'company_id'])->inverseOf('mkPrints');
    }
    }
