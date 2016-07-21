<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use kartik\grid\GridView;

/* @var $this yii\web\View */
/* @var $model app\models\OrderItem */

?>
<div class="order-item-view">

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
            'attribute' => 'order.name',
            'label' => 'Order',
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
    echo DetailView::widget([
        'model' => $model,
        'attributes' => $gridColumn
    ]); 
?>
    </div>
</div>