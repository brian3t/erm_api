<?php

namespace app\models\base;

use Yii;

/**
 * This is the base model class for table "mk_misc".
 *
 * @property integer $id
 * @property integer $marketing_id
 * @property integer $company_id
 * @property string $provider_company
 * @property string $created_at
 * @property string $updated_at
 * @property string $description
 * @property string $gross
 * @property string $net
 *
 * @property \app\models\Marketing $marketing
 * @property \app\models\Company $company
 */
class MkMisc extends \yii\db\ActiveRecord
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
            [['marketing_id', 'company_id'], 'integer'],
            [['created_at', 'updated_at'], 'safe'],
            [['gross', 'net'], 'number'],
            [['provider_company'], 'string', 'max' => 255],
            [['description'], 'string', 'max' => 2000]
        ];
    }

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'mk_misc';
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
            'description' => 'Description',
            'gross' => 'Gross',
            'net' => 'Net',
        ];
    }
    
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMarketing()
    {
        return $this->hasOne(\app\models\Marketing::className(), ['id' => 'marketing_id'])->inverseOf('mkMiscs');
    }
        
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCompany()
    {
        return $this->hasOne(\app\models\Company::className(), ['id' => 'company_id'])->inverseOf('mkMiscs');
    }
    }
