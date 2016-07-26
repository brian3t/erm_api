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
            'attribute' => 'order.id',
            'label' => 'Order',
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
        'pjax' => true,
        'pjaxSettings' => ['options' => ['id' => 'kv-pjax-container-order-shipment-package']],
        'panel' => [
        'type' => GridView::TYPE_PRIMARY,
        'heading' => '<span class="glyphicon glyphicon-book"></span> ' . Html::encode('Order Shipment Package'),
        ],
        'columns' => $gridColumnOrderShipmentPackage
    ]);
}
?>
    </div>
</div>