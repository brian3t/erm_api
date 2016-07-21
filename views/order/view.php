<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use kartik\grid\GridView;

/* @var $this yii\web\View */
/* @var $model app\models\Order */

$this->title = $model->id;
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
        'channel_refnum',
        'rop_order_id',
        'last_mp_updated',
        'last_rop_pull',
        'force_rop_resend',
        'count_rop_pull',
        'channel_date_created',
        'shipping_amt',
        'tax_amt',
        'first_name',
        'last_name',
        'company',
        'email:email',
        'address1',
        'address2',
        'city',
        'state_match',
        'country_match',
        'postal_code',
        'gift_message',
        'phone',
        'ship_first_name',
        'ship_last_name',
        'ship_company',
        'ship_address1',
        'ship_address2',
        'ship_city',
        'ship_state_match',
        'ship_country_match',
        'ship_postal_code',
        'ship_phone',
        'pay_type',
        'pay_transaction_id',
        'comments:ntext',
        'product_total',
        [
            'attribute' => 'customer.id',
            'label' => 'Customer',
        ],
        'discount_amt',
        'grand_total',
        'ship_service_code',
        'ip_address',
        'status',
        'attributes',
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
if($providerOrderPayment->totalCount){
    $gridColumnOrderPayment = [
        ['class' => 'yii\grid\SerialColumn'],
            ['attribute' => 'id', 'hidden' => true],
            [
                'attribute' => 'order.id',
                'label' => 'Order'
        ],
            'amount',
            'payment_processing_type',
            'transaction_type',
            'payment_type',
            'created_at',
            'updated_at',
    ];
    echo Gridview::widget([
        'dataProvider' => $providerOrderPayment,
        'pjax' => true,
        'pjaxSettings' => ['options' => ['id' => 'kv-pjax-container-order-payment']],
        'panel' => [
        'type' => GridView::TYPE_PRIMARY,
        'heading' => '<span class="glyphicon glyphicon-book"></span> ' . Html::encode('Order Payment'.' '. $this->title),
        ],
        'columns' => $gridColumnOrderPayment
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
                'attribute' => 'order.id',
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