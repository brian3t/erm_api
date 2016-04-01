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
?>

<div class="order-form">

    <?php $form = ActiveForm::begin(); ?>
    
    <?= $form->errorSummary($model); ?>

    <?= $form->field($model, 'id', ['template' => '{input}'])->textInput(['style' => 'display:none']); ?>

    <?= $form->field($model, 'mp_id')->textInput(['placeholder' => 'Mp']) ?>

    <?= $form->field($model, 'mp_reference_number')->textInput(['maxlength' => true, 'placeholder' => 'Mp Reference Number']) ?>

    <?= $form->field($model, 'rop_order_id')->textInput(['placeholder' => 'Rop Order']) ?>

    <?= $form->field($model, 'last_mp_updated')->textInput(['placeholder' => 'Last Mp Updated']) ?>

    <?= $form->field($model, 'last_rop_pull')->textInput(['placeholder' => 'Last Rop Pull']) ?>

    <?= $form->field($model, 'count_rop_pull')->textInput(['placeholder' => 'Count Rop Pull']) ?>

    <?= $form->field($model, 'order_date_time')->widget(\kartik\widgets\DateTimePicker::classname(), [
        'options' => ['placeholder' => 'Choose Order Date Time'],
        'pluginOptions' => [
            'autoclose' => true,
            'format' => 'mm/dd/yyyy hh:ii:ss'
        ]
    ]) ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true, 'placeholder' => 'Name']) ?>

    <?= $form->field($model, 'company')->textInput(['maxlength' => true, 'placeholder' => 'Company']) ?>

    <?= $form->field($model, 'email')->textInput(['maxlength' => true, 'placeholder' => 'Email']) ?>

    <?= $form->field($model, 'address')->textInput(['maxlength' => true, 'placeholder' => 'Address']) ?>

    <?= $form->field($model, 'address2')->textInput(['maxlength' => true, 'placeholder' => 'Address2']) ?>

    <?= $form->field($model, 'city')->textInput(['maxlength' => true, 'placeholder' => 'City']) ?>

    <?= $form->field($model, 'state')->textInput(['maxlength' => true, 'placeholder' => 'State']) ?>

    <?= $form->field($model, 'zip')->textInput(['maxlength' => true, 'placeholder' => 'Zip']) ?>

    <?= $form->field($model, 'country')->textInput(['maxlength' => true, 'placeholder' => 'Country']) ?>

    <?= $form->field($model, 'phone')->textInput(['maxlength' => true, 'placeholder' => 'Phone']) ?>

    <?= $form->field($model, 'ship_name')->textInput(['maxlength' => true, 'placeholder' => 'Ship Name']) ?>

    <?= $form->field($model, 'ship_company')->textInput(['maxlength' => true, 'placeholder' => 'Ship Company']) ?>

    <?= $form->field($model, 'ship_address')->textInput(['maxlength' => true, 'placeholder' => 'Ship Address']) ?>

    <?= $form->field($model, 'ship_address2')->textInput(['maxlength' => true, 'placeholder' => 'Ship Address2']) ?>

    <?= $form->field($model, 'ship_city')->textInput(['maxlength' => true, 'placeholder' => 'Ship City']) ?>

    <?= $form->field($model, 'ship_state')->textInput(['maxlength' => true, 'placeholder' => 'Ship State']) ?>

    <?= $form->field($model, 'ship_zip')->textInput(['maxlength' => true, 'placeholder' => 'Ship Zip']) ?>

    <?= $form->field($model, 'ship_country')->textInput(['maxlength' => true, 'placeholder' => 'Ship Country']) ?>

    <?= $form->field($model, 'ship_phone')->textInput(['maxlength' => true, 'placeholder' => 'Ship Phone']) ?>

    <?= $form->field($model, 'pay_type')->textInput(['maxlength' => true, 'placeholder' => 'Pay Type']) ?>

    <?= $form->field($model, 'pay_transaction_id')->textInput(['maxlength' => true, 'placeholder' => 'Pay Transaction']) ?>

    <?= $form->field($model, 'comments')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'product_total')->textInput(['maxlength' => true, 'placeholder' => 'Product Total']) ?>

    <?= $form->field($model, 'tax_total')->textInput(['maxlength' => true, 'placeholder' => 'Tax Total']) ?>

    <?= $form->field($model, 'shipping_total')->textInput(['maxlength' => true, 'placeholder' => 'Shipping Total']) ?>

    <?= $form->field($model, 'grand_total')->textInput(['maxlength' => true, 'placeholder' => 'Grand Total']) ?>

    <?= $form->field($model, 'shipping')->textInput(['maxlength' => true, 'placeholder' => 'Shipping']) ?>

    <?= $form->field($model, 'discount')->textInput(['maxlength' => true, 'placeholder' => 'Discount']) ?>

    <?= $form->field($model, 'status')->textInput(['maxlength' => true, 'placeholder' => 'Status']) ?>

    <div class="form-group" id="add-order-item"></div>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
