<?php
namespace app\api\modules\v1\controllers;

use app\api\base\controllers\BaseActiveController;
use yii\rest\ActiveController;
use yii\helpers\ArrayHelper;
use yii\filters\Cors;


class MkProductionController extends BaseActiveController
{
    // We are using the regular web app modules:
    public $modelClass = 'app\models\MkProduction';

}