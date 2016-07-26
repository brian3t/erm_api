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
    </div>

    <div class="row">
<?php 
    $gridColumn = [
                [
                'attribute' => 'mp.name',
                'label' => 'Mp'
            ],
        'channel_refnum',
        'rop_order_id',
        'last_mp_updated',
        'rop_ack_at',
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
                'label' => 'Customer'
            ],
        'discount_amt',
        'grand_total',
        'ship_service_code',
        'ip_address',
        'status',
        'attributes',
        'other_info',
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
    echo Gridview::widget([
        'dataProvider' => $providerOrderItem,
        'panel' => [
            'type' => GridView::TYPE_PRIMARY,
            'heading' => Html::encode('Order Item'),
        ],
        'panelHeadingTemplate' => '<h4>{heading}</h4>{summary}',
        'toggleData' => false,
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
                        'amount',
        'payment_processing_type',
        'transaction_type',
        'payment_type',
        'created_at',
        'updated_at',
    ];
    echo Gridview::widget([
        'dataProvider' => $providerOrderPayment,
        'panel' => [
            'type' => GridView::TYPE_PRIMARY,
            'heading' => Html::encode('Order Payment'),
        ],
        'panelHeadingTemplate' => '<h4>{heading}</h4>{summary}',
        'toggleData' => false,
        'columns' => $gridColumnOrderPayment
    ]);
}
?>
    </div>
    
    <div class="row">
<?php
if($providerOrderReturn->totalCount){
    $gridColumnOrderReturn = [
        ['class' => 'yii\grid\SerialColumn'],
                        'retailops_return_id',
        'retailops_rma_id',
        'product_amt',
        'subtotal_amt',
        'discount_amt',
        'shipping_amt',
        'tax_amt',
        'refund_amt',
        'created_at',
        'updated_at',
    ];
    echo Gridview::widget([
        'dataProvider' => $providerOrderReturn,
        'panel' => [
            'type' => GridView::TYPE_PRIMARY,
            'heading' => Html::encode('Order Return'),
        ],
        'panelHeadingTemplate' => '<h4>{heading}</h4>{summary}',
        'toggleData' => false,
        'columns' => $gridColumnOrderReturn
    ]);
}
?>
    </div>
    
    <div class="row">
<?php
if($providerOrderShipment->totalCount){
    $gridColumnOrderShipment = [
        ['class' => 'yii\grid\SerialColumn'],
                        'retailops_shipment_id',
        'created_at',
        'updated_at',
    ];
    echo Gridview::widget([
        'dataProvider' => $providerOrderShipment,
        'panel' => [
            'type' => GridView::TYPE_PRIMARY,
            'heading' => Html::encode('Order Shipment'),
        ],
        'panelHeadingTemplate' => '<h4>{heading}</h4>{summary}',
        'toggleData' => false,
        'columns' => $gridColumnOrderShipment
    ]);
}
?>
    </div>
</div>
