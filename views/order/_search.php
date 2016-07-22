<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\OrderSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="form-order-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

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

    <?php /* echo $form->field($model, 'rop_ack_at')->widget(\kartik\datecontrol\DateControl::classname(), [
        'type' => \kartik\datecontrol\DateControl::FORMAT_DATETIME,
        'saveFormat' => 'php:Y-m-d H:i:s',
        'ajaxConversion' => true,
        'options' => [
            'pluginOptions' => [
                'placeholder' => 'Choose Rop Ack At',
                'autoclose' => true,
            ]
        ],
    ]); */ ?>

    <?php /* echo $form->field($model, 'last_rop_pull')->textInput(['placeholder' => 'Last Rop Pull']) */ ?>

    <?php /* echo $form->field($model, 'force_rop_resend')->textInput(['placeholder' => 'Force Rop Resend']) */ ?>

    <?php /* echo $form->field($model, 'count_rop_pull')->textInput(['placeholder' => 'Count Rop Pull']) */ ?>

    <?php /* echo $form->field($model, 'channel_date_created')->widget(\kartik\datecontrol\DateControl::classname(), [
        'type' => \kartik\datecontrol\DateControl::FORMAT_DATETIME,
        'saveFormat' => 'php:Y-m-d H:i:s',
        'ajaxConversion' => true,
        'options' => [
            'pluginOptions' => [
                'placeholder' => 'Choose Channel Date Created',
                'autoclose' => true,
            ]
        ],
    ]); */ ?>

    <?php /* echo $form->field($model, 'shipping_amt')->textInput(['maxlength' => true, 'placeholder' => 'Shipping Amt']) */ ?>

    <?php /* echo $form->field($model, 'tax_amt')->textInput(['maxlength' => true, 'placeholder' => 'Tax Amt']) */ ?>

    <?php /* echo $form->field($model, 'first_name')->textInput(['maxlength' => true, 'placeholder' => 'First Name']) */ ?>

    <?php /* echo $form->field($model, 'last_name')->textInput(['maxlength' => true, 'placeholder' => 'Last Name']) */ ?>

    <?php /* echo $form->field($model, 'company')->textInput(['maxlength' => true, 'placeholder' => 'Company']) */ ?>

    <?php /* echo $form->field($model, 'email')->textInput(['maxlength' => true, 'placeholder' => 'Email']) */ ?>

    <?php /* echo $form->field($model, 'address1')->textInput(['maxlength' => true, 'placeholder' => 'Address1']) */ ?>

    <?php /* echo $form->field($model, 'address2')->textInput(['maxlength' => true, 'placeholder' => 'Address2']) */ ?>

    <?php /* echo $form->field($model, 'city')->textInput(['maxlength' => true, 'placeholder' => 'City']) */ ?>

    <?php /* echo $form->field($model, 'state_match')->textInput(['maxlength' => true, 'placeholder' => 'State Match']) */ ?>

    <?php /* echo $form->field($model, 'country_match')->textInput(['maxlength' => true, 'placeholder' => 'Country Match']) */ ?>

    <?php /* echo $form->field($model, 'postal_code')->textInput(['maxlength' => true, 'placeholder' => 'Postal Code']) */ ?>

    <?php /* echo $form->field($model, 'gift_message')->textInput(['maxlength' => true, 'placeholder' => 'Gift Message']) */ ?>

    <?php /* echo $form->field($model, 'phone')->textInput(['maxlength' => true, 'placeholder' => 'Phone']) */ ?>

    <?php /* echo $form->field($model, 'ship_first_name')->textInput(['maxlength' => true, 'placeholder' => 'Ship First Name']) */ ?>

    <?php /* echo $form->field($model, 'ship_last_name')->textInput(['maxlength' => true, 'placeholder' => 'Ship Last Name']) */ ?>

    <?php /* echo $form->field($model, 'ship_company')->textInput(['maxlength' => true, 'placeholder' => 'Ship Company']) */ ?>

    <?php /* echo $form->field($model, 'ship_address1')->textInput(['maxlength' => true, 'placeholder' => 'Ship Address1']) */ ?>

    <?php /* echo $form->field($model, 'ship_address2')->textInput(['maxlength' => true, 'placeholder' => 'Ship Address2']) */ ?>

    <?php /* echo $form->field($model, 'ship_city')->textInput(['maxlength' => true, 'placeholder' => 'Ship City']) */ ?>

    <?php /* echo $form->field($model, 'ship_state_match')->textInput(['maxlength' => true, 'placeholder' => 'Ship State Match']) */ ?>

    <?php /* echo $form->field($model, 'ship_country_match')->textInput(['maxlength' => true, 'placeholder' => 'Ship Country Match']) */ ?>

    <?php /* echo $form->field($model, 'ship_postal_code')->textInput(['maxlength' => true, 'placeholder' => 'Ship Postal Code']) */ ?>

    <?php /* echo $form->field($model, 'ship_phone')->textInput(['maxlength' => true, 'placeholder' => 'Ship Phone']) */ ?>

    <?php /* echo $form->field($model, 'pay_type')->textInput(['maxlength' => true, 'placeholder' => 'Pay Type']) */ ?>

    <?php /* echo $form->field($model, 'pay_transaction_id')->textInput(['maxlength' => true, 'placeholder' => 'Pay Transaction']) */ ?>

    <?php /* echo $form->field($model, 'comments')->textarea(['rows' => 6]) */ ?>

    <?php /* echo $form->field($model, 'product_total')->textInput(['maxlength' => true, 'placeholder' => 'Product Total']) */ ?>

    <?php /* echo $form->field($model, 'customer_id')->widget(\kartik\widgets\Select2::classname(), [
        'data' => \yii\helpers\ArrayHelper::map(\app\models\Customer::find()->orderBy('id')->asArray()->all(), 'id', 'id'),
        'options' => ['placeholder' => 'Choose Customer'],
        'pluginOptions' => [
            'allowClear' => true
        ],
    ]); */ ?>

    <?php /* echo $form->field($model, 'discount_amt')->textInput(['maxlength' => true, 'placeholder' => 'Discount Amt']) */ ?>

    <?php /* echo $form->field($model, 'grand_total')->textInput(['maxlength' => true, 'placeholder' => 'Grand Total']) */ ?>

    <?php /* echo $form->field($model, 'ship_service_code')->textInput(['maxlength' => true, 'placeholder' => 'Ship Service Code']) */ ?>

    <?php /* echo $form->field($model, 'ip_address')->textInput(['maxlength' => true, 'placeholder' => 'Ip Address']) */ ?>

    <?php /* echo $form->field($model, 'status')->textInput(['maxlength' => true, 'placeholder' => 'Status']) */ ?>

    <?php /* echo $form->field($model, 'attributes')->textInput(['maxlength' => true, 'placeholder' => 'Attributes']) */ ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
