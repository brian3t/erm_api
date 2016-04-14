<?php
namespace app\api\modules\v1\controllers;

use yii\rest\ActiveController;
use yii\helpers\ArrayHelper;
use yii\filters\Cors;


class InventoryController extends ActiveController
{
    // We are using the regular web app modules:
    public $modelClass = 'app\models\Inventory';

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

    public function actionPush()
    {
        \Yii::$app->response->headers->add('Content-type', 'application/json');
        $result = [
            'status' => 'failed'
        ];
        $data = \Yii::$app->request->post();

        $transaction = \Yii::$app->db->beginTransaction();
        try {
            foreach ($data as $sku => $quantity) {
                $command = \Yii::$app->db->createCommand('INSERT INTO `inventory`
                 (`sku`, `quantity`) 
                 VALUES (:sku, :quantity) ON DUPLICATE KEY UPDATE `quantity` = :quantity')
                    ->bindValues([':sku' => $sku, ':quantity' => $quantity]);
                $command->execute();
            }

            $transaction->commit();
            $result['status'] = 'successful';
            $result['count'] = count($data);
            \Yii::$app->response->setStatusCode(201);
        } catch (\Exception $e) {
            $transaction->rollBack();
            $result['info'] = "Transaction error: " . $e->getMessage();
            \Yii::$app->response->setStatusCode(500);
            throw $e;
        }

        echo json_encode($result);
        \Yii::$app->end(1);
    }
}