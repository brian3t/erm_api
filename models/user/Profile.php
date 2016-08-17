<?php

namespace app\models\user;

use yii\db\ActiveRecord;
use yii\web\UploadedFile;
use dektrium\user\models\Profile as BaseProfile;


/**
 * This is the model class for table "profile".
 *
 * @property string  $avatar
 *
 * @var UploadedFile avatarFile attribute
 */
class Profile extends BaseProfile {
    public $avatarFile;
    public function rules() {
        $rules                        = parent::rules();
        $rules['avatarLength']        = [ 'avatar','string','max' => 255 ];
        $rules['avatarFileSkipEmpty'] = [ 'avatarFile','file','skipOnEmpty' => true, ];

//		$rules['avatarFileImg'] = ['avatarFile','file','extensions' => 'gif, jpg, png',];
//		$rules['avatarFileIsImage'] = [['avatarFile'], 'file', 'extensions' => 'jpg, png', 'mimeTypes' => 'image/jpeg, image/png'];
        return $rules;
    }

    public function attributeLabels() {
        $al = parent::attributeLabels();
        $al = array_merge( $al,[
        ] );

    }

}