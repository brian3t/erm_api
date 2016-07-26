<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use kartik\grid\GridView;

/* @var $this yii\web\View */
/* @var $model app\models\OrderShipmentPackage */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Order Shipment Package', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="order-shipment-package-view">

    <div class="row">
        <div class="col-sm-9">
            <h2><?= 'Order Shipment Package'.' '. Html::encode($this->title) ?></h2>
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
            'attribute' => 'orderShipment.id',
            'label' => 'Order Shipment',
        ],
        'retailops_package_id',
        'carrier_name',
        'carrier_class_name',
        'channel_ship_code',
        'tracking_number',
        'weight_kg',
        'date_shipped',
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
if($providerOrderShipmentPackageItem->totalCount){
    $gridColumnOrderShipmentPackageItem = [
        ['class' => 'yii\grid\SerialColumn'],
                                    [
                'attribute' => 'orderItem.id',
                'label' => 'Order Item'
            ],
            'retailops_order_item_id',
            'retailops_shipment_item_id',
            'quantity',
            'created_at',
            'updated_at',
            'sku',
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