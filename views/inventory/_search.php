<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\InventorySearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="form-inventory-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id', ['template' => '{input}'])->textInput(['style' => 'display:none']); ?>

    <?= $form->field($model, 'sku')->textInput(['maxlength' => true, 'placeholder' => 'Sku']) ?>

    <?= $form->field($model, 'quantity_available')->textInput(['placeholder' => 'Quantity Available']) ?>

    <?= $form->field($model, 'updatetime')->textInput(['placeholder' => 'Updatetime']) ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
