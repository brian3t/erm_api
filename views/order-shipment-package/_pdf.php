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
    </div>

    <div class="row">
<?php 
    $gridColumn = [
                [
                'attribute' => 'orderShipment.id',
                'label' => 'Order Shipment'
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
                        'retailops_order_item_id',
        'retailops_shipment_item_id',
        'quantity',
        'created_at',
        'updated_at',
        [
                'attribute' => 'orderItem.id',
                'label' => 'Order Item ID'
            ],
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
