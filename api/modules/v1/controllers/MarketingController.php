<?php
namespace app\api\modules\v1\controllers;

use app\api\base\controllers\BaseActiveController;
use yii\db\Query;
use yii\rest\ActiveController;
use yii\helpers\ArrayHelper;
use yii\filters\Cors;


class MarketingController extends BaseActiveController
{
    public $modelClass = 'app\models\Marketing';

    public function actionIndex($user_id = null)
    {
        if (is_null($user_id) || empty($user_id)) {
            return (\app\models\Marketing::find())->all();
        }
        $result = [];
//        $result = \Yii::$app->db->createCommand('SELECT * FROM offer INNER JOIN (SELECT id AS user_id FROM user WHERE user.company_id = ' . $company_id . ') user
//        ON offer.user_id = user.user_id ')
//            ->queryAll();
        RETURN $result;
    }
}