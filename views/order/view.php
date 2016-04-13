<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use kartik\grid\GridView;

/* @var $this yii\web\View */
/* @var $model app\models\Order */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Order', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="order-view">

    <div class="row">
        <div class="col-sm-9">
            <h2><?= 'Order'.' '. Html::encode($this->title) ?></h2>
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
            'attribute' => 'mp.name',
            'label' => 'Mp',
        ],
        'mp_reference_number',
        'rop_order_id',
        'last_mp_updated',
        'last_rop_pull',
        'force_rop_resend',
        'count_rop_pull',
        'order_date_time',
        'name',
        'company',
        'email:email',
        'address',
        'address2',
        'city',
        'state',
        'zip',
        'country',
        'phone',
        'ship_name',
        'ship_company',
        'ship_address',
        'ship_address2',
        'ship_city',
        'ship_state',
        'ship_zip',
        'ship_country',
        'ship_phone',
        'pay_type',
        'pay_transaction_id',
        'comments:ntext',
        'product_total',
        'tax_total',
        'shipping_total',
        'grand_total',
        'shipping',
        'discount',
        'status',
        'note',
    ];
    echo DetailView::widget([
        'model' => $model,
        'attributes' => $gridColumn
    ]); 
?>
    </div>
    
    <div class="row">
<?php
if($providerOrderItem->totalCount){
    $gridColumnOrderItem = [
        ['class' => 'yii\grid\SerialColumn'],
            ['attribute' => 'id', 'hidden' => true],
            [
                'attribute' => 'order.name',
                'label' => 'Order'
        ],
            'sku',
            'product',
            'options',
            'price_per_unit',
            'quantity',
            'status',
            'last_mp_updated',
            'mp_item_id',
            'extra_info',
    ];
    echo Gridview::widget([
        'dataProvider' => $providerOrderItem,
        'pjax' => true,
        'pjaxSettings' => ['options' => ['id' => 'kv-pjax-container-order-item']],
        'panel' => [
        'type' => GridView::TYPE_PRIMARY,
        'heading' => '<span class="glyphicon glyphicon-book"></span> ' . Html::encode('Order Item'.' '. $this->title),
        ],
        'columns' => $gridColumnOrderItem
    ]);
}
?>
    </div>
    
    <div class="row">
<?php
if($providerTracking->totalCount){
    $gridColumnTracking = [
        ['class' => 'yii\grid\SerialColumn'],
            ['attribute' => 'id', 'hidden' => true],
            [
                'attribute' => 'order.name',
                'label' => 'Rop Order'
        ],
            'sku',
            'tracking_number',
            'tracking_carrier',
            'ship_date',
    ];
    echo Gridview::widget([
        'dataProvider' => $providerTracking,
        'pjax' => true,
        'pjaxSettings' => ['options' => ['id' => 'kv-pjax-container-tracking']],
        'panel' => [
        'type' => GridView::TYPE_PRIMARY,
        'heading' => '<span class="glyphicon glyphicon-book"></span> ' . Html::encode('Tracking'.' '. $this->title),
        ],
        'columns' => $gridColumnTracking
    ]);
}
?>
    </div>
</div>