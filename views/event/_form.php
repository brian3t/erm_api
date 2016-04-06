<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Event */
/* @var $form yii\widgets\ActiveForm */

?>

<div class="event-form">

    <?php $form = ActiveForm::begin(); ?>
    
    <?= $form->errorSummary($model); ?>

    <?= $form->field($model, 'id', ['template' => '{input}'])->textInput(['style' => 'display:none']); ?>

    <?= $form->field($model, 'action')->dropDownList([ 'MP ORDER IMPORT' => 'MP ORDER IMPORT', 'ROP ORDER PULL' => 'ROP ORDER PULL', ], ['prompt' => '']) ?>

    <?= $form->field($model, 'mp_id')->textInput(['placeholder' => 'Mp']) ?>

    <?= $form->field($model, 'start')->textInput(['placeholder' => 'Start']) ?>

    <?= $form->field($model, 'stop')->textInput(['placeholder' => 'Stop']) ?>

    <?= $form->field($model, 'note')->textInput(['maxlength' => true, 'placeholder' => 'Note']) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
        <?= Html::a(Yii::t('app', 'Cancel'),['index'],['class'=> 'btn btn-danger']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
