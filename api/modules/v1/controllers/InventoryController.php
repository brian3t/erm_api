<?php
namespace app\api\modules\v1\controllers;

use app\api\base\controllers\BaseActiveController;
use yii\rest\ActiveController;
use yii\helpers\ArrayHelper;
use yii\filters\Cors;


class InventoryController extends BaseActiveController
{
    // We are using the regular web app modules:
    public $modelClass = 'app\models\Inventory';
    
    public function actionPush()
    {
        $result = [
            'status' => 'failed'
        ];
        
        $transaction = \Yii::$app->db->beginTransaction();
        if (empty($this->requestbody->inventory_updates)){
            return;
        }
        
        try {
            foreach ($this->requestbody->inventory_updates as $inventory_update) {
                
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