<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\OrderPayment */
/* @var $form yii\widgets\ActiveForm */

?>

<div class="order-payment-form">

    <?php $form = ActiveForm::begin(); ?>
    
    <?= $form->errorSummary($model); ?>

    <?= $form->field($model, 'id', ['template' => '{input}'])->textInput(['style' => 'display:none']); ?>

    <?= $form->field($model, 'order_id')->widget(\kartik\widgets\Select2::classname(), [
        'data' => \yii\helpers\ArrayHelper::map(\app\models\Order::find()->orderBy('id')->asArray()->all(), 'id', 'ship_first_name'),
        'options' => ['placeholder' => 'Choose Order'],
        'pluginOptions' => [
            'allowClear' => true
        ],
    ]) ?>

    <?= $form->field($model, 'amount')->textInput(['maxlength' => true, 'placeholder' => 'Amount']) ?>

    <?= $form->field($model, 'type')->dropDownList([ 'charge' => 'Charge', 'cash' => 'Cash', 'cheque' => 'Cheque', ], ['prompt' => '']) ?>

    <?= $form->field($model, 'payment_type')->dropDownList([ 'visa' => 'Visa', ], ['prompt' => '']) ?>

    <?= $form->field($model, 'created_at')->widget(\kartik\widgets\DateTimePicker::classname(), [
        'options' => ['placeholder' => 'Choose Created At'],
        'pluginOptions' => [
            'autoclose' => true,
            'format' => 'mm/dd/yyyy hh:ii:ss'
        ]
    ]) ?>

    <?= $form->field($model, 'updated_at')->widget(\kartik\widgets\DateTimePicker::classname(), [
        'options' => ['placeholder' => 'Choose Updated At'],
        'pluginOptions' => [
            'autoclose' => true,
            'format' => 'mm/dd/yyyy hh:ii:ss'
        ]
    ]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
