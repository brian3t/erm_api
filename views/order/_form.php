<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Order */
/* @var $form yii\widgets\ActiveForm */

\mootensai\components\JsBlock::widget(['viewFile' => '_script', 'pos'=> \yii\web\View::POS_END, 
    'viewParams' => [
        'class' => 'OrderItem', 
        'relID' => 'order-item', 
        'value' => \yii\helpers\Json::encode($model->orderItems),
        'isNewRecord' => ($model->isNewRecord) ? 1 : 0
    ]
]);
\mootensai\components\JsBlock::widget(['viewFile' => '_script', 'pos'=> \yii\web\View::POS_END, 
    'viewParams' => [
        'class' => 'OrderPayment', 
        'relID' => 'order-payment', 
        'value' => \yii\helpers\Json::encode($model->orderPayments),
        'isNewRecord' => ($model->isNewRecord) ? 1 : 0
    ]
]);
\mootensai\components\JsBlock::widget(['viewFile' => '_script', 'pos'=> \yii\web\View::POS_END, 
    'viewParams' => [
        'class' => 'Tracking', 
        'relID' => 'tracking', 
        'value' => \yii\helpers\Json::encode($model->trackings),
        'isNewRecord' => ($model->isNewRecord) ? 1 : 0
    ]
]);
?>

<div class="order-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->errorSummary($model); ?>

    <?= $form->field($model, 'id', ['template' => '{input}'])->textInput(['style' => 'display:none']); ?>

    <?= $form->field($model, 'mp_id')->widget(\kartik\widgets\Select2::classname(), [
        'data' => \yii\helpers\ArrayHelper::map(\app\models\Mp::find()->orderBy('id')->asArray()->all(), 'id', 'name'),
        'options' => ['placeholder' => 'Choose Mp'],
        'pluginOptions' => [
            'allowClear' => true
        ],
    ]); ?>

    <?= $form->field($model, 'channel_refnum')->textInput(['maxlength' => true, 'placeholder' => 'Channel Refnum']) ?>

    <?= $form->field($model, 'rop_order_id')->textInput(['placeholder' => 'Rop Order']) ?>

    <?= $form->field($model, 'last_mp_updated')->textInput(['placeholder' => 'Last Mp Updated']) ?>

    <?= $form->field($model, 'rop_ack_at')->widget(\kartik\datecontrol\DateControl::classname(), [
        'type' => \kartik\datecontrol\DateControl::FORMAT_DATETIME,
        'saveFormat' => 'php:Y-m-d H:i:s',
        'ajaxConversion' => true,
        'options' => [
            'pluginOptions' => [
                'placeholder' => 'Choose Rop Ack At',
                'autoclose' => true,
            ]
        ],
    ]); ?>

    <?= $form->field($model, 'last_rop_pull')->textInput(['placeholder' => 'Last Rop Pull']) ?>

    <?= $form->field($model, 'force_rop_resend')->textInput(['placeholder' => 'Force Rop Resend']) ?>

    <?= $form->field($model, 'count_rop_pull')->textInput(['placeholder' => 'Count Rop Pull']) ?>

    <?= $form->field($model, 'channel_date_created')->widget(\kartik\datecontrol\DateControl::classname(), [
        'type' => \kartik\datecontrol\DateControl::FORMAT_DATETIME,
        'saveFormat' => 'php:Y-m-d H:i:s',
        'ajaxConversion' => true,
        'options' => [
            'pluginOptions' => [
                'placeholder' => 'Choose Channel Date Created',
                'autoclose' => true,
            ]
        ],
    ]); ?>

    <?= $form->field($model, 'shipping_amt')->textInput(['maxlength' => true, 'placeholder' => 'Shipping Amt']) ?>

    <?= $form->field($model, 'tax_amt')->textInput(['maxlength' => true, 'placeholder' => 'Tax Amt']) ?>

    <?= $form->field($model, 'first_name')->textInput(['maxlength' => true, 'placeholder' => 'First Name']) ?>

    <?= $form->field($model, 'last_name')->textInput(['maxlength' => true, 'placeholder' => 'Last Name']) ?>

    <?= $form->field($model, 'company')->textInput(['maxlength' => true, 'placeholder' => 'Company']) ?>

    <?= $form->field($model, 'email')->textInput(['maxlength' => true, 'placeholder' => 'Email']) ?>

    <?= $form->field($model, 'address1')->textInput(['maxlength' => true, 'placeholder' => 'Address1']) ?>

    <?= $form->field($model, 'address2')->textInput(['maxlength' => true, 'placeholder' => 'Address2']) ?>

    <?= $form->field($model, 'city')->textInput(['maxlength' => true, 'placeholder' => 'City']) ?>

    <?= $form->field($model, 'state_match')->textInput(['maxlength' => true, 'placeholder' => 'State Match']) ?>

    <?= $form->field($model, 'country_match')->textInput(['maxlength' => true, 'placeholder' => 'Country Match']) ?>

    <?= $form->field($model, 'postal_code')->textInput(['maxlength' => true, 'placeholder' => 'Postal Code']) ?>

    <?= $form->field($model, 'gift_message')->textInput(['maxlength' => true, 'placeholder' => 'Gift Message']) ?>

    <?= $form->field($model, 'phone')->textInput(['maxlength' => true, 'placeholder' => 'Phone']) ?>

    <?= $form->field($model, 'ship_first_name')->textInput(['maxlength' => true, 'placeholder' => 'Ship First Name']) ?>

    <?= $form->field($model, 'ship_last_name')->textInput(['maxlength' => true, 'placeholder' => 'Ship Last Name']) ?>

    <?= $form->field($model, 'ship_company')->textInput(['maxlength' => true, 'placeholder' => 'Ship Company']) ?>

    <?= $form->field($model, 'ship_address1')->textInput(['maxlength' => true, 'placeholder' => 'Ship Address1']) ?>

    <?= $form->field($model, 'ship_address2')->textInput(['maxlength' => true, 'placeholder' => 'Ship Address2']) ?>

    <?= $form->field($model, 'ship_city')->textInput(['maxlength' => true, 'placeholder' => 'Ship City']) ?>

    <?= $form->field($model, 'ship_state_match')->textInput(['maxlength' => true, 'placeholder' => 'Ship State Match']) ?>

    <?= $form->field($model, 'ship_country_match')->textInput(['maxlength' => true, 'placeholder' => 'Ship Country Match']) ?>

    <?= $form->field($model, 'ship_postal_code')->textInput(['maxlength' => true, 'placeholder' => 'Ship Postal Code']) ?>

    <?= $form->field($model, 'ship_phone')->textInput(['maxlength' => true, 'placeholder' => 'Ship Phone']) ?>

    <?= $form->field($model, 'pay_type')->textInput(['maxlength' => true, 'placeholder' => 'Pay Type']) ?>

    <?= $form->field($model, 'pay_transaction_id')->textInput(['maxlength' => true, 'placeholder' => 'Pay Transaction']) ?>

    <?= $form->field($model, 'comments')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'product_total')->textInput(['maxlength' => true, 'placeholder' => 'Product Total']) ?>

    <?= $form->field($model, 'customer_id')->widget(\kartik\widgets\Select2::classname(), [
        'data' => \yii\helpers\ArrayHelper::map(\app\models\Customer::find()->orderBy('id')->asArray()->all(), 'id', 'name'),
        'options' => ['placeholder' => 'Choose Customer'],
        'pluginOptions' => [
            'allowClear' => true
        ],
    ]); ?>

    <?= $form->field($model, 'discount_amt')->textInput(['maxlength' => true, 'placeholder' => 'Discount Amt']) ?>

    <?= $form->field($model, 'grand_total')->textInput(['maxlength' => true, 'placeholder' => 'Grand Total']) ?>

    <?= $form->field($model, 'ship_service_code')->textInput(['maxlength' => true, 'placeholder' => 'Ship Service Code']) ?>

    <?= $form->field($model, 'ip_address')->textInput(['maxlength' => true, 'placeholder' => 'Ip Address']) ?>

    <?= $form->field($model, 'status')->textInput(['maxlength' => true, 'placeholder' => 'Status']) ?>

    <?= $form->field($model, 'attributes')->textInput(['maxlength' => true, 'placeholder' => 'Attributes']) ?>

    <?php
    $forms = [
        [
            'label' => '<i class="glyphicon glyphicon-book"></i> ' . Html::encode('OrderItem'),
            'content' => $this->render('_formOrderItem', [
                'row' => \yii\helpers\ArrayHelper::toArray($model->orderItems),
            ]),
        ],
        [
            'label' => '<i class="glyphicon glyphicon-book"></i> ' . Html::encode('OrderPayment'),
            'content' => $this->render('_formOrderPayment', [
                'row' => \yii\helpers\ArrayHelper::toArray($model->orderPayments),
            ]),
        ],
        [
            'label' => '<i class="glyphicon glyphicon-book"></i> ' . Html::encode('Tracking'),
            'content' => $this->render('_formTracking', [
                'row' => \yii\helpers\ArrayHelper::toArray($model->trackings),
            ]),
        ],
    ];
    echo kartik\tabs\TabsX::widget([
        'items' => $forms,
        'position' => kartik\tabs\TabsX::POS_ABOVE,
        'encodeLabels' => false,
        'pluginOptions' => [
            'bordered' => true,
            'sideways' => true,
            'enableCache' => false,
        ],
    ]);
    ?>
    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
        <?= Html::a(Yii::t('app', 'Cancel'), Yii::$app->request->referrer , ['class'=> 'btn btn-danger']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
