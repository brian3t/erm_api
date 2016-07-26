<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use kartik\grid\GridView;

/* @var $this yii\web\View */
/* @var $model app\models\OrderShipmentPackageItem */

?>
<div class="order-shipment-package-item-view">

    <div class="row">
        <div class="col-sm-9">
            <h2><?= Html::encode($model->id) ?></h2>
        </div>
    </div>

    <div class="row">
<?php 
    $gridColumn = [
        ['attribute' => 'id', 'hidden' => true],
        [
            'attribute' => 'orderShipmentPackage.id',
            'label' => 'Order Shipment Package',
        ],
        'retailops_order_item_id',
        'retailops_shipment_item_id',
        'quantity',
        'created_at',
        'updated_at',
        [
            'attribute' => 'orderItem.id',
            'label' => 'Sku',
        ],
        'rop_channel_item_refnum',
    ];
    echo DetailView::widget([
        'model' => $model,
        'attributes' => $gridColumn
    ]); 
?>
    </div>
</div>