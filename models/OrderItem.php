<?php

namespace app\models;

use Yii;
use \app\models\base\OrderItem as BaseOrderItem;

/**
 * This is the model class for table "order_item".
 */
class OrderItem extends BaseOrderItem
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return array_replace_recursive(parent::rules(),
            [
                [['order_id', 'sku'], 'required'],
                [['order_id', 'quantity'], 'integer'],
                [['unit_price', 'discount_amt', 'discount_pct', 'recycling_amt', 'ship_amt', 'shiptax_amt', 'unit_tax', 'unit_tax_pct', 'vat_pct'], 'number'],
                [['item_type'], 'string'],
                [['last_mp_updated'], 'safe'],
                [['sku'], 'string', 'max' => 255],
                [['sku_description', 'extra_info'], 'string', 'max' => 800],
                [['options'], 'string', 'max' => 2550],
                [['status'], 'string', 'max' => 250],
                [['mp_item_id'], 'string', 'max' => 50],
            ]);
    }
    
    public function beforeValidate()
    {
        $this->mp_item_id = strval($this->mp_item_id);
        return parent::beforeValidate();
    }
    
    public function fields()
    {
        return ['channel_item_refnum' => 'mp_item_id', 'sku' => function () {
            return $this->getRop_sku();
        }, 'sku_description', 'quantity', 'item_type',
            'currency_values' => function () {
                return ['discount_amt' => $this->getDiscount_amt(), 'discount_pct' => $this->getDiscount_pct(), 'recycling_amt' => $this->getRecycling_amt(),
                    'ship_amt' => $this->getShip_amt(), 'shiptax_amt' => $this->getShiptax_amt(), 'unit_price' => $this->getUnit_price(),
                    'unit_tax' => $this->getUnit_tax(), 'unit_tax_pct' => $this->getUnit_tax_pct(), 'vat_pct' => $this->getVat_pct()];
            }];
    }
    
    public function getRop_sku()
    {
        return floatval($this->sku);
    }
    
    public function getDiscount_amt()
    {
        return floatval($this->discount_amt);
    }
    
    public function getDiscount_pct()
    {
        return floatval($this->discount_pct);
    }
    
    public function getRecycling_amt()
    {
        return floatval($this->recycling_amt);
    }
    
    public function getShip_amt()
    {
        return floatval($this->ship_amt);
    }
    
    public function getShiptax_amt()
    {
        return floatval($this->shiptax_amt);
    }
    
    public function getUnit_price()
    {
        return floatval($this->unit_price);
    }
    
    public function getUnit_tax()
    {
        return floatval($this->unit_tax);
    }
    
    public function getUnit_tax_pct()
    {
        return floatval($this->unit_tax_pct);
    }
    
    public function getVat_pct()
    {
        return floatval($this->vat_pct);
    }
    
    public function getQuantity()
    {
        return intval($this->quantity);
    }
}
