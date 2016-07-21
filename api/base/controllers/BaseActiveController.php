<?php

namespace app\api\base\controllers;

use app\api\base\RequestBody;
use yii\rest\ActiveController;
use yii\web\Response;
use yii\helpers\ArrayHelper;
use yii\filters\Cors;

/**
 * Class BaseActiveController
 * @package app\api\base\controllers
 * @property RequestBody $requestbody
 * @property string $message
 */
class BaseActiveController extends ActiveController
{
    public $requestbody;
    public $message;
    public function behaviors()
    {
        $behaviors = parent::behaviors();
        $behaviors['contentNegotiator']['formats']['text/html'] = Response::FORMAT_JSON;
        
        return ArrayHelper::merge([
            [
                'class' => Cors::className(),
                'cors' => [
                    'Origin' => ['*'],
                ],
            ],
            // 'authenticator' => ['class' => HttpBasicAuth::className()]
        ], $behaviors);
    }
    
    public function actions()
    {
        $actions = parent::actions();
        return array_replace_recursive($actions, [
            'index' => [
                'class' => 'app\api\base\BaseIndexAction',
                'modelClass' => $this->modelClass,
                'checkAccess' => [$this, 'checkAccess'],
            ],
        ]);
    }
    
}