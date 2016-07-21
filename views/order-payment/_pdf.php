<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use kartik\grid\GridView;

/* @var $this yii\web\View */
/* @var $model app\models\OrderPayment */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Order Payment', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="order-payment-view">

    <div class="row">
        <div class="col-sm-9">
            <h2><?= 'Order Payment'.' '. Html::encode($this->title) ?></h2>
        </div>
    </div>

    <div class="row">
<?php 
    $gridColumn = [
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
    echo DetailView::widget([
        'model' => $model,
        'attributes' => $gridColumn
    ]); 
?>
    </div>
</div>
