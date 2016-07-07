<?php

namespace app\api\modules\v1\controllers;

use yii\rest\ActiveController;
use yii\web\Response;
use yii\helpers\ArrayHelper;
use yii\filters\Cors;

class BaseActiveController extends ActiveController
{
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
    
}