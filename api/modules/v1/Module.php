<?php
// Check this namespace:
namespace app\api\modules\v1;

use app\api\base\RequestBody;

class Module extends \yii\base\Module
{
    public function init()
    {
        parent::init();
        
        // ...  other initialization code ...
    }
    
    public function beforeAction($action)
    {
        $entity_body = file_get_contents('php://input');//{"action":"order_pull","channel_info":{"id":21},"client_id":497,"integration_auth_token":"RETAILOPS_SDK","page_token":"string","specific_orders":[{"channel_refnum":"141"}],"version":1}
        $request_body = new RequestBody($entity_body);
        
        if ((!property_exists($request_body, 'integration_auth_token') || $request_body->integration_auth_token !== 'RETAILOPS_SDK')) {//NOTE FOR PRODUCTION THIS TOKEN IS DIFFERENT
            \Yii::error('Missing or wrong integration auth token' . json_encode($request_body));
            \Yii::$app->response->setStatusCode('401');
            return false;
        }
        \Yii::$app->controller->requestbody = $request_body;
        return parent::beforeAction($action);
    }
    
    public function afterAction($action, $result)
    {
        $controller_id = \Yii::$app->controller->id;
        if (!$result) {
                \Yii::$app->response->setStatusCode(400);
            return \Yii::$app->controller->message?['error'=>\Yii::$app->controller->message]:'';
        }
        
        if (!is_array($result)) {
            $result = [];
        }
        array_walk($result, function (&$item) {
            if (is_null($item)) {
                $item = strval($item);
            };
        });
        switch ($action->id) {
            case 'pull':
                $new_result = ['next_page_token' => 'here', "{$controller_id}s" => $result];
                return parent::afterAction($action, $new_result);
                break;
            default:
                return parent::afterAction($action, $result);
                break;
        }
    }
}