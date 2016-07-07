<?php
namespace app\api\modules\v1\controllers;

use app\api\modules\v1\controllers\BaseActiveController;
use yii\rest\ActiveController;
use yii\helpers\ArrayHelper;
use yii\filters\Cors;


class EventController extends BaseActiveController
{
    // We are using the regular web app modules:
    public $modelClass = 'app\models\Event';

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
}