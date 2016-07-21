<?php

namespace app\api\base;

use yii\base\Exception;


/**
 * Class RequestBody
 * @package api\base
 *
 * @property string $action
 * @property integer version
 * @property integer channel_id
 * @property integer client_id
 * @property string integration_auth_token
 * @property string $page_token
 *
 * @property array $specific_orders
 *
 * @property array $catalog_items
 *
 * @property array $inventory_updates
 *
 */
class RequestBody
{
    public $action = null;
    public $version;
    public $client_id;
    public $channel_info;
    public $channel_id;
    public $page_token;
    public $specific_orders;
    public $inventory_updates;
    
    public function __construct($postbody)
    {
        if (!is_string($postbody)) return false;
        try {
            ($postbody = json_decode($postbody));
        } catch (Exception $e) {
            \Yii::error('Bad post body from ROP' . $e->getMessage());
            return false;
        }
        $this->import($postbody);
        // $this->action = $postbody->action??null;
        // $this->version = $postbody->version??null;
        // $this->channel_info = $postbody->channel_info??null;
        $this->channel_id = $this->channel_info->id??null;
        if (is_null($this->channel_id) && !IS_DEBUG) {
            \Yii::error('Missing channel id');
            return false;
        }
        // $this->client_id = $postbody->client_id??null;
        // $this->integration_auth_token = $postbody->integration_auth_token??null;
        // $this->page_token = $postbody->page_token??null;
        // $this->specific_orders = $postbody->specific_orders??[];
        
        return $this;
    }
    
    public function import(\stdClass $object)
    {
        foreach (get_object_vars($object) as $key => $value) {
            $this->$key = $value;
        }
    }
    
}