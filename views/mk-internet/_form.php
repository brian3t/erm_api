<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\MkInternet */
/* @var $form yii\widgets\ActiveForm */

?>

<div class="mk-internet-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->errorSummary($model); ?>

    <?= $form->field($model, 'id', ['template' => '{input}'])->textInput(['style' => 'display:none']); ?>

    <?= $form->field($model, 'marketing_id')->widget(\kartik\widgets\Select2::classname(), [
        'data' => \yii\helpers\ArrayHelper::map(\app\models\Marketing::find()->orderBy('id')->asArray()->all(), 'id', 'id'),
        'options' => ['placeholder' => 'Choose Marketing'],
        'pluginOptions' => [
            'allowClear' => true
        ],
    ]); ?>

    <?= $form->field($model, 'company_id')->widget(\kartik\widgets\Select2::classname(), [
        'data' => \yii\helpers\ArrayHelper::map(\app\models\Company::find()->orderBy('id')->asArray()->all(), 'id', 'name'),
        'options' => ['placeholder' => 'Choose Company'],
        'pluginOptions' => [
            'allowClear' => true
        ],
    ]); ?>

    <?= $form->field($model, 'print_media')->textInput(['maxlength' => true, 'placeholder' => 'Print Media']) ?>

    <?= $form->field($model, 'type')->textInput(['maxlength' => true, 'placeholder' => 'Type']) ?>

    <?= $form->field($model, 'contact')->textInput(['maxlength' => true, 'placeholder' => 'Contact']) ?>

    <?= $form->field($model, 'phone_email')->textInput(['maxlength' => true, 'placeholder' => 'Phone Email']) ?>

    <?= $form->field($model, 'size')->textInput(['maxlength' => true, 'placeholder' => 'Size']) ?>

    <?= $form->field($model, 'promo_tickets')->textInput(['placeholder' => 'Promo Tickets']) ?>

    <?= $form->field($model, 'promo_value')->textInput(['maxlength' => true, 'placeholder' => 'Promo Value']) ?>

    <?= $form->field($model, 'paid_run_from')->widget(\kartik\datecontrol\DateControl::classname(), [
        'type' => \kartik\datecontrol\DateControl::FORMAT_DATE,
        'saveFormat' => 'php:Y-m-d',
        'ajaxConversion' => true,
        'options' => [
            'pluginOptions' => [
                'placeholder' => 'Choose Paid Run From',
                'autoclose' => true
            ]
        ],
    ]); ?>

    <?= $form->field($model, 'paid_run_to')->widget(\kartik\datecontrol\DateControl::classname(), [
        'type' => \kartik\datecontrol\DateControl::FORMAT_DATE,
        'saveFormat' => 'php:Y-m-d',
        'ajaxConversion' => true,
        'options' => [
            'pluginOptions' => [
                'placeholder' => 'Choose Paid Run To',
                'autoclose' => true
            ]
        ],
    ]); ?>

    <?= $form->field($model, 'promo_run_from')->widget(\kartik\datecontrol\DateControl::classname(), [
        'type' => \kartik\datecontrol\DateControl::FORMAT_DATE,
        'saveFormat' => 'php:Y-m-d',
        'ajaxConversion' => true,
        'options' => [
            'pluginOptions' => [
                'placeholder' => 'Choose Promo Run From',
                'autoclose' => true
            ]
        ],
    ]); ?>

    <?= $form->field($model, 'promo_run_to')->widget(\kartik\datecontrol\DateControl::classname(), [
        'type' => \kartik\datecontrol\DateControl::FORMAT_DATE,
        'saveFormat' => 'php:Y-m-d',
        'ajaxConversion' => true,
        'options' => [
            'pluginOptions' => [
                'placeholder' => 'Choose Promo Run To',
                'autoclose' => true
            ]
        ],
    ]); ?>

    <?= $form->field($model, 'qty')->textInput(['placeholder' => 'Qty']) ?>

    <?= $form->field($model, 'monday')->textInput(['maxlength' => true, 'placeholder' => 'Monday']) ?>

    <?= $form->field($model, 'tuesday')->textInput(['maxlength' => true, 'placeholder' => 'Tuesday']) ?>

    <?= $form->field($model, 'wednesday')->textInput(['maxlength' => true, 'placeholder' => 'Wednesday']) ?>

    <?= $form->field($model, 'thursday')->textInput(['maxlength' => true, 'placeholder' => 'Thursday']) ?>

    <?= $form->field($model, 'friday')->textInput(['maxlength' => true, 'placeholder' => 'Friday']) ?>

    <?= $form->field($model, 'saturday')->textInput(['maxlength' => true, 'placeholder' => 'Saturday']) ?>

    <?= $form->field($model, 'sunday')->textInput(['maxlength' => true, 'placeholder' => 'Sunday']) ?>

    <?= $form->field($model, 'gross')->textInput(['maxlength' => true, 'placeholder' => 'Gross']) ?>

    <?= $form->field($model, 'net')->textInput(['maxlength' => true, 'placeholder' => 'Net']) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
