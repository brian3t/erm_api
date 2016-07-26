<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use kartik\grid\GridView;

/* @var $this yii\web\View */
/* @var $model app\models\OrderItem */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Order Item', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="order-item-view">

    <div class="row">
        <div class="col-sm-9">
            <h2><?= 'Order Item'.' '. Html::encode($this->title) ?></h2>
        </div>
    </div>

    <div class="row">
<?php 
    $gridColumn = [
                [
                'attribute' => 'order.id',
                'label' => 'Order'
            ],
        'sku',
        'sku_description',
        'options',
        'unit_price',
        'discount_amt',
        'discount_pct',
        'recycling_amt',
        'ship_amt',
        'shiptax_amt',
        'unit_tax',
        'unit_tax_pct',
        'vat_pct',
        'quantity',
        'item_type',
        'status',
        'last_mp_updated',
        'mp_item_id',
        'extra_info',
        'created_at',
        'updated_at',
    ];
    echo DetailView::widget([
        'model' => $model,
        'attributes' => $gridColumn
    ]); 
?>
    </div>
    
    <div class="row">
<?php
if($providerOrderReturnItem->totalCount){
    $gridColumnOrderReturnItem = [
        ['class' => 'yii\grid\SerialColumn'],
                [
                'attribute' => 'orderReturn.id',
                'label' => 'Order Return'
            ],
        'retailops_item_id',
        'channel_item_refnum',
                'quantity',
        'reason',
        'item_shipping_tax_amt',
        'tax_amt',
        'shipping_amt',
        'restock_fee_amt',
        'giftwrap_amt',
        'giftwrap_tax_amt',
        'product_amt',
        'recycling_amt',
        'subtotal_amt',
        'credit_amt',
    ];
    echo Gridview::widget([
        'dataProvider' => $providerOrderReturnItem,
        'panel' => [
            'type' => GridView::TYPE_PRIMARY,
            'heading' => Html::encode('Order Return Item'),
        ],
        'panelHeadingTemplate' => '<h4>{heading}</h4>{summary}',
        'toggleData' => false,
        'columns' => $gridColumnOrderReturnItem
    ]);
}
?>
    </div>
    
    <div class="row">
<?php
if($providerOrderShipmentPackageItem->totalCount){
    $gridColumnOrderShipmentPackageItem = [
        ['class' => 'yii\grid\SerialColumn'],
                [
                'attribute' => 'orderShipmentPackage.id',
                'label' => 'Order Shipment Package'
            ],
        'retailops_order_item_id',
        'retailops_shipment_item_id',
        'quantity',
        'created_at',
        'updated_at',
                'rop_channel_item_refnum',
    ];
    echo Gridview::widget([
        'dataProvider' => $providerOrderShipmentPackageItem,
        'panel' => [
            'type' => GridView::TYPE_PRIMARY,
            'heading' => Html::encode('Order Shipment Package Item'),
        ],
        'panelHeadingTemplate' => '<h4>{heading}</h4>{summary}',
        'toggleData' => false,
        'columns' => $gridColumnOrderShipmentPackageItem
    ]);
}
?>
    </div>
</div>
