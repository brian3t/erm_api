<?php
namespace app\api\modules\v1\controllers;

// define("DEBUG", false);
define("DEBUG", true);
define('LIMIT', 18);
define('DAYS_SINCE_LAST_ROP_PULL', 30);

use app\models\Mp;
use app\models\Order;
use yii\base\Exception;
use yii\data\ActiveDataProvider;
use yii\db\ActiveQuery;
use yii\db\QueryBuilder;
use yii\filters\auth\HttpBasicAuth;
use yii\grid\GridView;
use yii\rest\Action;
use yii\rest\ActiveController;
use yii\helpers\ArrayHelper;
use yii\filters\Cors;
use yii\rest\IndexAction;
use yii\web\Application;
use yii\web\Controller;


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

        // disable the "delete" actions
        unset($actions['delete']);

        // customize the data provider preparation with the "prepareDataProvider()" method
        $actions['index']['class'] = 'app\api\modules\v1\controllers\OrderAction';
        $actions['index']['prepareDataProvider'] = [$this, 'prepareDataProvider'];
        // $actions['index']['checkAccess'] = [$this, 'checkAccess'];

        return $actions;
    }

    public function prepareDataProvider()
    {
        // prepare and return a data provider for the "index" action

        $last_rop_pull = (new \DateTime())->sub((new \DateInterval("P". DAYS_SINCE_LAST_ROP_PULL ."D")))->format('Y-m-d');

        $query = Order::find()->joinWith('mp')
            ->where(['or', ['rop_order_id' => null], ['force_rop_resend' => 1]])
            ->andWhere(['or', ['>=', 'last_rop_pull', $last_rop_pull], ['last_rop_pull' => null]])
            ->limit(DEBUG ? LIMIT : null);
        
        $mp_end_point = \Yii::$app->request->getQueryParam('mp');
        $mp = Mp::findOne(['end_point_name' => $mp_end_point]);
        if (is_object($mp)) {
            $query->andWhere(['mp_id' => $mp->id]);
        }

        $days_back = intval(\Yii::$app->request->getQueryParam('days_back'));
        if (!empty($days_back)) {
            $formatted_date = new \DateTime();
            $formatted_date = $formatted_date->sub((new \DateInterval("P" . $days_back . "D")))->format('Y-m-d');
            $query->andWhere(['>=', 'order_date_time', $formatted_date]);
        }

        $dp = new ActiveDataProvider(
            ['query' => $query]
        );
        if (DEBUG) {
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

    /**
     * ROP Endpoint: Order Confirmation
     * @param string $mp_endpoint_name Marketplace endpoint name, e.g. loehmanns
     * Expects json_encoded Associative array of orders. Each order is a key-value pair:
     *      sme_order_id    :   rop_order_id, e.g.     123 : ABC123
     * @return string A json encoded array with the following information:
     * {
     *  status: successful|failed
     *  count: Number of orders updated
     *  info:   further information, such as error at ROP side, error at SME side
     * }
     *
     * @throws \Exception $e Database exception
     */
    public function actionConfirm($mp_endpoint_name = null)
    {
        \Yii::$app->response->format = \yii\web\Response::FORMAT_HTML;
        $result = [
            'status' => 'failed',
        ];
        // if (!\Yii::$app->request->isAjax){
        //     $result['info'] = 'Request is not ajax';
        //     return json_encode($result);
        // }
        // if (is_null($mp_endpoint_name)){
        //     $result['info'] = 'No endpoint name given';
        //     return json_encode($result);
        // }
        // $mp = Mp::findOne(['end_point_name' => $mp_endpoint_name]);
        // if (!is_object($mp)){
        //     $result['info'] = 'Bad endpoint name';
        //     return json_encode($result);
        // }
        // $mp_id = $mp->id;
        $data = \Yii::$app->request->post();

        // if (is_string($data)) {
        //
        //     try {
        //         $data = json_decode($data);
        //     } catch (Exception $e) {
        //         \Yii::warning('Data received from order confirm is not string but not json string.');
        //     }
        // }

        // \Yii::warning('data: '. print_r($data, true));
        
        $transaction = \Yii::$app->db->beginTransaction();
        try {
            foreach ($data as $sme_order_id => $rop_order_id) {
                $command = \Yii::$app->db->createCommand('UPDATE `order` SET `rop_order_id` = :rop_order_id, `force_rop_resend` = NULL WHERE `id` = :id')
                    ->bindValues([':rop_order_id' => $rop_order_id, ':id' => $sme_order_id]);
                $command->execute();
                \Yii::error("db: " . $command->rawSql);
            }

            $transaction->commit();
            $result['status'] = 'successful';
            $result['count'] = count($data);
        } catch (\Exception $e) {
            $transaction->rollBack();
            $result['info'] = "Transaction error: " . $e->getMessage();
            throw $e;
        }

        return json_encode($result);
    }
    
    public function actionBlah()
    {
        return '{"bleh":1}';
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
        //pull active data provider
        $dp = $this->prepareDataProvider;
        //pull query params

        //todov2 pull query parameters from action index. It's the same params that prepareDataProvider (see above) uses
        $query = \Yii::$app->db->createCommand('UPDATE `order` SET last_rop_pull = NOW(), count_rop_pull = count_rop_pull + 1 WHERE rop_order_id IS NULL OR `order`.force_rop_resend = 1 LIMIT ' . LIMIT . ';')
            ->execute();
        return parent::run();
    }

}