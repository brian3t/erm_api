<?php
/**
 * Created by IntelliJ IDEA.
 * User: tri
 * Date: 8/10/16
 * Time: 8:57 AM
 */

namespace app\models;


/**
 * Class User
 * @package app\models
 *
 * @property \app\models\CompanyUser $companyUser
 *
 */
class User extends \dektrium\user\models\User
{
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCompanyUser()
    {
        return $this->hasOne(\app\models\CompanyUser::className(), ['user_id' => 'id'])->inverseOf('user');
    }
    
    public function getCompany()
    {
        return $this->companyUser?$this->companyUser->company:null;
    }
    
}