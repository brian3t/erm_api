<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use kartik\grid\GridView;

/* @var $this yii\web\View */
/* @var $model app\models\Order */

?>
<div class="order-view">

    <div class="row">
        <div class="col-sm-9">
            <h2><?= Html::encode($model->name) ?></h2>
        </div>
    </div>

    <div class="row">
<?php 
    $gridColumn = [
        ['attribute' => 'id', 'hidden' => true],
        'mp_id',
        'mp_reference_number',
        'rop_order_id',
        'last_mp_updated',
        'last_rop_pull',
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
    ];
    echo DetailView::widget([
        'model' => $model,
        'attributes' => $gridColumn
    ]); 
?>
    </div>
</div>