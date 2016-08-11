<?php
/**
 * Created by IntelliJ IDEA.
 * User: tri
 * Date: 8/11/16
 * Time: 8:48 AM
 */

namespace app\controllers\user;

use dektrium\user\Finder;
use dektrium\user\models\Profile;
use dektrium\user\models\SettingsForm;
use dektrium\user\Module;
use dektrium\user\traits\AjaxValidationTrait;
use dektrium\user\traits\EventTrait;
use Yii;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;
use yii\web\Controller;
use yii\web\ForbiddenHttpException;
use yii\web\NotFoundHttpException;

class SettingsController extends \dektrium\user\controllers\SettingsController
{
    public function getFinder(){
        return $this->finder;
    }
    public function actionApiProfile(){
        $response = ['status' => 'failed'];
        $model = $this->finder->findProfileById(Yii::$app->user->identity->getId());
    
        if ($model == null) {
            $model = Yii::createObject(Profile::className());
            $model->link('user', Yii::$app->user->identity);
        }
    
        $event = $this->getProfileEvent($model);
    
        $this->trigger(self::EVENT_BEFORE_PROFILE_UPDATE, $event);
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            $this->trigger(self::EVENT_AFTER_PROFILE_UPDATE, $event);
            return ['status' => 'success', 'message' => 'Your profile has been updated'];
        }
    
        return $model->attributes;
    }
}