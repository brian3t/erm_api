<?php
namespace app\api\modules\v1\controllers;

use app\api\base\controllers\BaseActiveController;
use app\api\base\RequestBody;
use yii\rest\ActiveController;
use yii\helpers\ArrayHelper;
use yii\filters\Cors;

/**
 * Class CatalogController
 * @package app\api\modules\v1\controllers
 * @property array $catalog_items
 */
class CatalogController extends BaseActiveController
{
    // We are using the regular web app modules:
    public $modelClass = 'app\models\Catalog';
    
    public function actionGet_config()
    {
        return ['sku_fanout'=>'no_fanout'];
    }
    
    public function actionGetconfig()
    {
        return ['sku_fanout'=>'no_fanout'];
    }
    
    public function actionPush(){
        return ['event'=>[
            // ['event_type'=>'info']
        ]];
        
        $result = [];
        if (!property_exists($this->requestbody, 'catalog_items')) {
            $this->message .='Missing catalog_items';
            return false;
        }
        $catalog_items = $this->requestbody->catalog_items;
        $catalog_items_sku = array_filter($catalog_items, function ($v) {
            return $v->item_type == 'sku';
        });
                
        return $result;
    }
    
    
}