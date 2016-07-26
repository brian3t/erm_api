<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use kartik\grid\GridView;

/* @var $this yii\web\View */
/* @var $model app\models\OrderReturnItem */

?>
<div class="order-return-item-view">

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
            'attribute' => 'orderReturn.id',
            'label' => 'Order Return',
        ],
        'retailops_item_id',
        'channel_item_refnum',
        [
            'attribute' => 'orderItem.sku',
            'label' => 'Order Item',
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