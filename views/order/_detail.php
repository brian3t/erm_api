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
            <h2><?= Html::encode($model->id) ?></h2>
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
            'label' => 'Customer',
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
</div>