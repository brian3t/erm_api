<?php
namespace app\api\modules\v1\controllers;

use app\api\base\controllers\BaseActiveController;
use app\api\base\RequestBody;
use yii\rest\ActiveController;
use yii\helpers\ArrayHelper;
use yii\filters\Cors;
use Yii;
use dektrium\user\models\SettingsForm;

/**
 * Class SettingsController
 * @package app\api\modules\v1\controllers
 * @property array $catalog_items
 */
class SettingsController extends BaseActiveController
{
    // We are using the regular web app modules:
    public $modelClass = 'app\models\SettingsForm';
    
    public function actionAccount(){
        
        /** @var SettingsForm $model */
        $model = \Yii::createObject(SettingsForm::className());
        if ($model->load(\Yii::$app->request->post()) && $model->save()) {
            return [true];
        }
        return [false];
    }
    
    
}