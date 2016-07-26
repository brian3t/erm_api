<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use kartik\grid\GridView;

/* @var $this yii\web\View */
/* @var $model app\models\OrderReturn */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Order Return', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="order-return-view">

    <div class="row">
        <div class="col-sm-9">
            <h2><?= 'Order Return'.' '. Html::encode($this->title) ?></h2>
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
                                    'retailops_item_id',
            'channel_item_refnum',
            [
                'attribute' => 'orderItem.id',
                'label' => 'Order Item ID'
            ],
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
</div>