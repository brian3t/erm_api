<?php
namespace app\api\modules\v1\controllers;

use yii\rest\ActiveController;
use yii\helpers\ArrayHelper;
use yii\filters\Cors;


class EventController extends ActiveController
{
    // We are using the regular web app modules:
    public $modelClass = 'app\models\Event';

    public function behaviors()
    {
        return ArrayHelper::merge([
                                      [
                                          'class' => Cors::className(),
                                          'cors' => [
                                              'Origin' => ['http://brianng', 'http://brianng:8080', 'http://localhost:8080', 'http://api.ngxtri.com',
                                                  'http://api.brianng'],
                                          ],
                                      ],
                                  ], parent::behaviors());
    }
}