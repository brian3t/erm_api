<?php

namespace app\models\base;

use Yii;

/**
 * This is the base model class for table "company_user".
 *
 * @property integer $id
 * @property integer $company_id
 * @property integer $user_id
 * @property string $role
 *
 * @property \app\models\Company $company
 * @property \app\models\User $user
 */
class CompanyUser extends \yii\db\ActiveRecord
{
    use \mootensai\relation\RelationTrait;
    
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['company_id', 'user_id'], 'required'],
            [['company_id', 'user_id'], 'integer'],
            [['role'], 'string'],
            [
                ['company_id', 'user_id'],
                'unique',
                'targetAttribute' => ['company_id', 'user_id'],
                'message' => 'The combination of Company ID and User ID has already been taken.',
            ],
        ];
    }
    
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'company_user';
    }
    
    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'company_id' => 'Company ID',
            'user_id' => 'User ID',
            'role' => 'Role',
        ];
    }
    
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCompany()
    {
        return $this->hasOne(\app\models\Company::className(), ['id' => 'company_id'])->inverseOf('companyUsers');
    }
    
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(\app\models\User::className(), ['id' => 'user_id'])->inverseOf('companyUser');
    }
}
