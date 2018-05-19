<?php

namespace app\models\base;

use Yii;

/**
 * This is the base model class for table "marketing".
 *
 * @property integer $id
 * @property integer $offer_id
 * @property integer $user_id
 * @property string $created_at
 * @property string $updated_at
 * @property string $budget
 * @property string $note
 *
 * @property \app\models\User $user
 * @property \app\models\Offer $offer
 * @property \app\models\MkInternet[] $mkInternets
 * @property \app\models\MkMisc[] $mkMiscs
 * @property \app\models\MkPrint[] $mkPrints
 * @property \app\models\MkProduction[] $mkProductions
 * @property \app\models\MkRadio[] $mkRadios
 * @property \app\models\MkTelevision[] $mkTelevisions
 */
class Marketing extends \yii\db\ActiveRecord
{
    use \mootensai\relation\RelationTrait;


    /**
    * This function helps \mootensai\relation\RelationTrait runs faster
    * @return array relation names of this model
    */
    public function relationNames()
    {
        return [
            'user',
            'offer',
            'mkInternets',
            'mkMiscs',
            'mkPrints',
            'mkProductions',
            'mkRadios',
            'mkTelevisions'
        ];
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['offer_id', 'user_id'], 'required'],
            [['offer_id', 'user_id'], 'integer'],
            [['created_at', 'updated_at'], 'safe'],
            [['budget'], 'number'],
            [['note'], 'string', 'max' => 2000],
            [['offer_id'], 'unique']
        ];
    }

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'marketing';
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'offer_id' => 'Offer ID',
            'user_id' => 'User ID',
            'budget' => 'Budget',
            'note' => 'Note',
        ];
    }
    
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(\app\models\User::className(), ['id' => 'user_id'])->inverseOf('marketings');
    }
        
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getOffer()
    {
        return $this->hasOne(\app\models\Offer::className(), ['id' => 'offer_id'])->inverseOf('marketing');
    }
        
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMkInternets()
    {
        return $this->hasMany(\app\models\MkInternet::className(), ['marketing_id' => 'id'])->inverseOf('marketing');
    }
        
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMkMiscs()
    {
        return $this->hasMany(\app\models\MkMisc::className(), ['marketing_id' => 'id'])->inverseOf('marketing');
    }
        
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMkPrints()
    {
        return $this->hasMany(\app\models\MkPrint::className(), ['marketing_id' => 'id'])->inverseOf('marketing');
    }
        
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMkProductions()
    {
        return $this->hasMany(\app\models\MkProduction::className(), ['marketing_id' => 'id'])->inverseOf('marketing');
    }
        
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMkRadios()
    {
        return $this->hasMany(\app\models\MkRadio::className(), ['marketing_id' => 'id'])->inverseOf('marketing');
    }
        
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMkTelevisions()
    {
        return $this->hasMany(\app\models\MkTelevision::className(), ['marketing_id' => 'id'])->inverseOf('marketing');
    }
    }
