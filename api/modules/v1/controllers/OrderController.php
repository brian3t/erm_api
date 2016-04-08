<?php
namespace app\api\modules\v1\controllers;

// define("DEBUG", false);
define("DEBUG", true);
define('LIMIT', 18);

use app\models\Order;
use yii\data\ActiveDataProvider;
use yii\db\QueryBuilder;
use yii\filters\auth\HttpBasicAuth;
use yii\rest\Action;
use yii\rest\ActiveController;
use yii\helpers\ArrayHelper;
use yii\filters\Cors;
use yii\rest\IndexAction;


class OrderController extends ActiveController
{
    // We are using the regular web app modules:
    public $modelClass = 'app\models\Order';

    /**
     * @var callable a PHP callable that will be called when running an action to determine
     * if the current user has the permission to execute the action. If not set, the access
     * check will not be performed. The signature of the callable should be as follows,
     *
     * ```php
     * function ($action, $model = null) {
     *     // $model is the requested model instance.
     *     // If null, it means no specific model (e.g. IndexAction)
     * }
     * ```
     */
    public $checkAccess;

    /**
     * @var callable a PHP callable that will be called to prepare a data provider that
     * should return a collection of the models. If not set, [[prepareDataProvider()]] will be used instead.
     * The signature of the callable should be:
     *
     * ```php
     * function ($action) {
     *     // $action is the action object currently running
     * }
     * ```
     *
     * The callable should return an instance of [[ActiveDataProvider]].
     */
    public $prepareDataProvider;

    public function actions()
    {
        $actions = parent::actions();

        // disable the "delete" and "create" actions
        unset($actions['delete'], $actions['create']);

        // customize the data provider preparation with the "prepareDataProvider()" method
        $actions['index']['class'] = 'app\api\modules\v1\controllers\OrderAction';
        $actions['index']['prepareDataProvider'] = [$this, 'prepareDataProvider'];
        // $actions['index']['checkAccess'] = [$this, 'checkAccess'];


        return $actions;
    }

    public function prepareDataProvider()
    {
        // prepare and return a data provider for the "index" action
        $dp = new ActiveDataProvider(
            ['query' => Order::find()->where(['rop_order_id' => null])->limit(DEBUG ? LIMIT : null)]
        );
        if(DEBUG)
        {
            $dp->pagination = false;
        }
        return $dp;
    }

    public function behaviors()
    {
        return ArrayHelper::merge([
            [
                'class' => Cors::className(),
                'cors' => [
                    'Origin' => ['*'],
                ],
            ],
            // 'authenticator' => ['class' => HttpBasicAuth::className()]
        ], parent::behaviors());
    }

    public function checkAccess($action, $model = null, $params = [])
    {
        return parent::checkAccess($action, $model, $params);
    }

    public function actionPull($id)
    {
        return Order::findOne($id);
    }
}

class OrderAction extends IndexAction
{
    /**
     * @return ActiveDataProvider
     * Also mark exported items's last_rop_pull
     * And increase the number of times they got pulled by ROP
     */
    public function run()
    {
        //todov2 pull query parameters from action index. It's the same params that prepareDataProvider (see above) uses
        $query = \Yii::$app->db->createCommand('UPDATE `order` set last_rop_pull = NOW(), count_rop_pull = count_rop_pull + 1 WHERE rop_order_id IS NULL LIMIT '. LIMIT. ';')
        ->execute();
        return parent::run();
    }

}