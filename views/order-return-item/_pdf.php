<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use kartik\grid\GridView;

/* @var $this yii\web\View */
/* @var $model app\models\OrderReturnItem */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Order Return Item', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="order-return-item-view">

    <div class="row">
        <div class="col-sm-9">
            <h2><?= 'Order Return Item'.' '. Html::encode($this->title) ?></h2>
        </div>
    </div>

    <div class="row">
<?php 
    $gridColumn = [
                [
                'attribute' => 'orderReturn.id',
                'label' => 'Order Return'
            ],
        'retailops_item_id',
        'channel_item_refnum',
        [
                'attribute' => 'orderItem.id',
                'label' => 'Sku'
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
    echo DetailView::widget([
        'model' => $model,
        'attributes' => $gridColumn
    ]); 
?>
    </div>
</div>