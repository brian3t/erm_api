<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\InventoryDetail */
/* @var $form yii\widgets\ActiveForm */

?>

<div class="inventory-detail-form">

    <?php $form = ActiveForm::begin(); ?>
    
    <?= $form->errorSummary($model); ?>

    <?= $form->field($model, 'id', ['template' => '{input}'])->textInput(['style' => 'display:none']); ?>

    <?= $form->field($model, 'quantity_type')->dropDownList([ 'internal' => 'Internal', 'external' => 'External', 'inflight' => 'Inflight', ], ['prompt' => '']) ?>

    <?= $form->field($model, 'inventory_id')->widget(\kartik\widgets\Select2::classname(), [
        'data' => \yii\helpers\ArrayHelper::map(\app\models\Inventory::find()->orderBy('id')->asArray()->all(), 'id', 'id'),
        'options' => ['placeholder' => 'Choose Inventory'],
        'pluginOptions' => [
            'allowClear' => true
        ],
    ]) ?>

    <?= $form->field($model, 'estimated_availability_date')->widget(\kartik\widgets\DateTimePicker::classname(), [
        'options' => ['placeholder' => 'Choose Estimated Availability Date'],
        'pluginOptions' => [
            'autoclose' => true,
            'format' => 'mm/dd/yyyy hh:ii:ss'
        ]
    ]) ?>

    <?= $form->field($model, 'available_quantity')->textInput(['placeholder' => 'Available Quantity']) ?>

    <?= $form->field($model, 'total_quantity')->textInput(['placeholder' => 'Total Quantity']) ?>

    <?= $form->field($model, 'vendor_name')->textInput(['maxlength' => true, 'placeholder' => 'Vendor Name']) ?>

    <?= $form->field($model, 'po')->textInput(['maxlength' => true, 'placeholder' => 'Po']) ?>

    <?= $form->field($model, 'po_destination')->textInput(['maxlength' => true, 'placeholder' => 'Po Destination']) ?>

    <?= $form->field($model, 'facility_name')->textInput(['maxlength' => true, 'placeholder' => 'Facility Name']) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
        <?= Html::a(Yii::t('app', 'Cancel'),['index'],['class'=> 'btn btn-danger']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
