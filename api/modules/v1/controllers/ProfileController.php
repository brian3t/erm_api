<?php
namespace app\api\modules\v1\controllers;

use app\api\base\controllers\BaseActiveController;
use yii\rest\ActiveController;
use yii\helpers\ArrayHelper;
use yii\filters\Cors;


class ProfileController extends BaseActiveController
{
    // We are using the regular web app modules:
    public $modelClass = 'app\models\Profile';

    public function actionImage($user_id=null)
    {
        if ($user_id == null){
            return;
        }
    }
}