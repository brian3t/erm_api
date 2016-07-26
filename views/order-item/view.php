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
        <div class="col-sm-3" style="margin-top: 15px">
            
            <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
            <?= Html::a('Delete', ['delete', 'id' => $model->id], [
                'class' => 'btn btn-danger',
                'data' => [
                    'confirm' => 'Are you sure you want to delete this item?',
                    'method' => 'post',
                ],
            ])
            ?>
        </div>
    </div>

    <div class="row">
<?php 
    $gridColumn = [
        ['attribute' => 'id', 'hidden' => true],
        [
            'attribute' => 'order.name',
            'label' => 'Order',
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
        'pjax' => true,
        'pjaxSettings' => ['options' => ['id' => 'kv-pjax-container-order-return-item']],
        'panel' => [
        'type' => GridView::TYPE_PRIMARY,
        'heading' => '<span class="glyphicon glyphicon-book"></span> ' . Html::encode('Order Return Item'),
        ],
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
        'pjax' => true,
        'pjaxSettings' => ['options' => ['id' => 'kv-pjax-container-order-shipment-package-item']],
        'panel' => [
        'type' => GridView::TYPE_PRIMARY,
        'heading' => '<span class="glyphicon glyphicon-book"></span> ' . Html::encode('Order Shipment Package Item'),
        ],
        'columns' => $gridColumnOrderShipmentPackageItem
    ]);
}
?>
    </div>
</div>