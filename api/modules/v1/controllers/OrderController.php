<?php
namespace app\api\modules\v1\controllers;

// define("DEBUG", false);
define("DEBUG", true);
define('LIMIT', 8);
define('DAYS_SINCE_LAST_ROP_PULL', 30);

use app\api\base\controllers\BaseActiveController;
use app\models\Mp;
use app\models\Order;
use app\models\OrderQuery;
use app\models\OrderShipment;
use app\models\OrderShipmentPackage;
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
use yii\web\Response;

class OrderController extends BaseActiveController
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
    
    protected function verbs()
    {
        $verbs = parent::verbs();
        array_push($verbs['update'], 'POST');
    }
    
    public function actions()
    {
        $actions = parent::actions();
        
        // disable the default REST actions
        unset($actions['delete']);
        unset($actions['update']);
        
        // customize the data provider preparation with the "prepareDataProvider()" method
        $actions['pull']['class'] = 'app\api\modules\v1\controllers\OrderPullAction';
        $actions['pull']['modelClass'] = $this->modelClass;
        $actions['pull']['prepareDataProvider'] = [$this, 'prepareDataProviderPull'];
        // $actions['index']['checkAccess'] = [$this, 'checkAccess'];
        
        return $actions;
    }
    
    public function prepareDataProviderPull()
    {
        // prepare and return a data provider for the "pull" action
        
        $last_rop_pull = (new \DateTime())->sub((new \DateInterval("P" . DAYS_SINCE_LAST_ROP_PULL . "D")))->format('Y-m-d');
        
        $query = Order::find()
            ->with('orderPayments')
            ->joinWith('mp')
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
            $query->andWhere(['>=', 'channel_date_created', $formatted_date]);
        }
        
        $dp = new ActiveDataProvider(
            [
                'query' => $query,
                'pagination' => [
                    'pageSize' => 100,
                ],
            ]
        );
        if (DEBUG) {
            // $dp->pagination = false;
        }
        return $dp;
        
    }
    
    public function checkAccess($action, $model = null, $params = [])
    {
        return parent::checkAccess($action, $model, $params);
    }
    
    public function actionPull()
    {
        header('Content-Type: application/json');
        return;
        // return Order::findAll();
    }
    
    public function actionAcknowledge()
    {
        $result = ['status' => 'fail'];
        $errors = [];
        $today = date('Y-m-d H:i:s');
        
        if (!property_exists($this->requestbody, 'orders')) {
            return $result;
        }
        // $order_to_acks = ArrayHelper::toArray($this->requestbody->orders);
        $successful = true;
        $count = 0;
        
        $trans = \Yii::$app->db->beginTransaction();
        foreach ($this->requestbody->orders as $order_to_ack) {
            $order = Order::find()->where(['channel_refnum' => $order_to_ack->channel_order_refnum])->one();
            if (is_object($order)) {
                /* @var Order $order */;
                $order->rop_order_id = $order_to_ack->retailops_order_id;
                $order->rop_ack_at = $today;
                if (!$order->save()) {
                    $successful = false;
                    array_push($errors, $order->getErrors());
                } else {
                    $count++;
                }
            }
        }
        $trans->commit();
        
        $result['errors'] = $errors;
        $result['status'] = $successful ? 'successful' : 'fail';
        $result['count'] = $count;
        return $result;
    }
    
    /**
     * ROP Endpoint: Order Confirmation
     * @param string $mp_endpoint_name Marketplace endpoint name, e.g. loehmanns
     * Expects json_encoded Associative array of orders. Each order is a key-value pair:
     *      sme_order_id    :   rop_order_id, e.g.     123 : ABC123
     * @return string A json encoded array with the following information:
     * {
     *  status: successful|fail
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
            'status' => 'fail',
        ];
        $data = \Yii::$app->request->post();
        
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
    
    public function actionCancel()
    {
        $result = ['status' => 'fail'];
        $errors = [];
        $today = date('Y-m-d H:i:s');
        
        if (!property_exists($this->requestbody, 'order')) {
            return $result;
        }
        $successful = true;
        
        $order = Order::find()->where(['rop_order_id' => $this->requestbody->order->retailops_order_id])->one();
        if (!is_object($order)) {
            $errors[] = ['message' => 'Can not find order using retailops_order_id'];
            $order = Order::find()->where(['channel_refnum' => $this->requestbody->order->channel_order_refnum])->one();
            if (!is_object($order)) {
                $successful = false;
                $errors[] = ['message' => 'Can not find order using channel_order_refnum'];
            }
        }
        if (is_object($order)) {
            /* @var Order $order */;
            $order->status = 'canceled';
            $order->rop_ack_at = $today;
            if (!$order->save()) {
                $successful = false;
                array_push($errors, $order->getErrors());
            }
        }
        
        
        $result['errors'] = $errors;
        $result['status'] = $successful ? 'successful' : 'fail';
        return $result;
    }
    
    public function actionComplete()
    {
        $result = ['status' => 'fail'];
        $errors = [];
        $today = date('Y-m-d H:i:s');
        
        if (!property_exists($this->requestbody, 'order')) {
            return $result;
        }
        $successful = true;
        $order_new = $this->requestbody->order;
        
        $order = Order::find()->where(['rop_order_id' => $order_new->retailops_order_id])->one();
        if (!is_object($order)) {
            $errors[] = ['message' => 'Can not find order using retailops_order_id'];
            $order = Order::find()->where(['channel_refnum' => $this->requestbody->order->channel_order_refnum])->one();
            if (!is_object($order)) {
                $successful = false;
                $errors[] = ['message' => 'Can not find order using channel_order_refnum'];
            }
        }
        if (is_object($order)) {
            /* @var Order $order */;
            // $order->status = 'complete';
            $order->setOther_info(['unshipped_items' => $order_new->unshipped_items]);
            $shipments = ArrayHelper::toArray($order_new->shipments);
            
            $order->unlinkAll('orderShipments', true);
            foreach ($shipments as &$shipment) {
                $shipmentPackages = $shipment['packages'];
                unset($shipment['packages']);
                
                $shipmentAR = new OrderShipment();
                $shipmentAR->load(['OrderShipment' => $shipment]);
                $shipmentAR->link('order', $order);
                $shipmentAR->save();
                
                foreach ($shipmentPackages as $shipmentPackage) {
                    $shipmentPackageItems = $shipmentPackage['package_items'];
                    unset($shipmentPackage['package_items']);
                    $shipmentPackageAR = new OrderShipmentPackage();
                    $shipmentPackageAR->loadAll(['OrderShipmentPackage' => $shipmentPackage, 'OrderShipmentPackageItem' => $shipmentPackageItems]);
                    $shipmentPackageAR->link('orderShipment', $shipmentAR);
                    $shipmentPackageAR->saveAll();
                }
            }
        }
        
        
        $result['errors'] = $errors;
        $result['status'] = $successful ? 'successful' : 'fail';
        return $result;
    }
    
    public function actionReturned()
    {
        $result = ['status' => 'fail'];
        $errors = [];
        $today = date('Y-m-d H:i:s');
        
        if (!property_exists($this->requestbody, 'order')) {
            return $result;
        }
        $successful = true;
        $order_new = $this->requestbody->order;//todob pulls data from API
        
        $order = Order::find()->where(['rop_order_id' => $order_new->retailops_order_id])->one();
        if (!is_object($order)) {
            $errors[] = ['message' => 'Can not find order using retailops_order_id'];
            $order = Order::find()->where(['channel_refnum' => $this->requestbody->order->channel_order_refnum])->one();
            if (!is_object($order)) {
                $successful = false;
                $errors[] = ['message' => 'Can not find order using channel_order_refnum'];
            }
        }
        if (is_object($order)) {
            /* @var Order $order */;
        }
        $result['errors'] = $errors;
        $result['status'] = $successful ? 'successful' : 'fail';
        return $result;
    }
    
    public function actionUpdate()
    {
        return;
    }
    
    public function actionBlah()
    {
        return '{"bleh":1}';
    }
}

class OrderPullAction extends IndexAction
{
    /**
     * @return ActiveDataProvider
     * Also mark exported items's last_rop_pull
     * And increase the number of times they got pulled by ROP
     */
    public function run()
    {
        //pull active data provider
        // \Yii::$app->response->statusCode = 401;
        $dp = $this->prepareDataProvider;
        /** @var ActiveDataProvider $dp */
        //pull query params
        
        //todov2 pull query parameters from action index. It's the same params that prepareDataProvider (see above) uses
        // $query = \Yii::$app->db->createCommand('UPDATE `order` SET last_rop_pull = NOW(), count_rop_pull = count_rop_pull + 1 WHERE rop_order_id IS NULL OR `order`.force_rop_resend = 1 LIMIT ' . LIMIT . ';')
        //     ->execute();
        
        return call_user_func($this->prepareDataProvider, $this);
    }
    
}