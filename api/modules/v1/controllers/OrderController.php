<?php
namespace app\api\modules\v1\controllers;

use yii\rest\ActiveController;
use yii\helpers\ArrayHelper;
use yii\filters\Cors;


class OrderController extends ActiveController
{
    // We are using the regular web app modules:
    public $modelClass = 'app\models\Order';

    public function behaviors()
    {
        return ArrayHelper::merge([
                                      [
                                          'class' => Cors::className(),
                                          'cors' => [
                                              'Origin' => ['*'],
                                          ],
                                      ],
                                  ], parent::behaviors());
    }

    //todob overwrite order pull
}