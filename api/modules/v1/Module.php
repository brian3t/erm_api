<?php
// Check this namespace:
namespace app\api\modules\v1;

class Module extends \yii\base\Module
{
    public function init()
    {
        parent::init();

        // ...  other initialization code ...
    }
    
    public function afterAction($action, $result)
    {
        $new_result = ['next_page_token' => 'here', 'orders' => $result];
        return parent::afterAction($action, $new_result);
    }
}