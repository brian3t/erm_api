<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use kartik\grid\GridView;

/* @var $this yii\web\View */
/* @var $model app\models\OrderShipment */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Order Shipment', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="order-shipment-view">

    <div class="row">
        <div class="col-sm-9">
            <h2><?= 'Order Shipment'.' '. Html::encode($this->title) ?></h2>
        </div>
    </div>

    <div class="row">
<?php 
    $gridColumn = [
                [
                'attribute' => 'order.id',
                'label' => 'Order'
            ],
        'retailops_shipment_id',
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
if($providerOrderShipmentPackage->totalCount){
    $gridColumnOrderShipmentPackage = [
        ['class' => 'yii\grid\SerialColumn'],
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
    echo Gridview::widget([
        'dataProvider' => $providerOrderShipmentPackage,
        'panel' => [
            'type' => GridView::TYPE_PRIMARY,
            'heading' => Html::encode('Order Shipment Package'),
        ],
        'panelHeadingTemplate' => '<h4>{heading}</h4>{summary}',
        'toggleData' => false,
        'columns' => $gridColumnOrderShipmentPackage
    ]);
}
?>
    </div>
</div>
