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
            'rop_order_id',
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
            'pay_type',
            'pay_transaction_id',
            'comments:ntext',
            'discount',
            'status',
            [
                'label' => 'Note',
                'value' => $model->getNote(),
                'format' => 'ntext'
            ]

        ];
        echo DetailView::widget([
            'model' => $model,
            'attributes' => $gridColumn
        ]);
        ?>
    </div>
</div>