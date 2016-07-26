<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\OrderItemSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="form-order-item-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id', ['template' => '{input}'])->textInput(['style' => 'display:none']); ?>

    <?= $form->field($model, 'order_id')->widget(\kartik\widgets\Select2::classname(), [
        'data' => \yii\helpers\ArrayHelper::map(\app\models\Order::find()->orderBy('id')->asArray()->all(), 'id', 'id'),
        'options' => ['placeholder' => 'Choose Order'],
        'pluginOptions' => [
            'allowClear' => true
        ],
    ]); ?>

    <?= $form->field($model, 'sku')->textInput(['maxlength' => true, 'placeholder' => 'Sku']) ?>

    <?= $form->field($model, 'sku_description')->textInput(['maxlength' => true, 'placeholder' => 'Sku Description']) ?>

    <?= $form->field($model, 'options')->textInput(['maxlength' => true, 'placeholder' => 'Options']) ?>

    <?php /* echo $form->field($model, 'unit_price')->textInput(['maxlength' => true, 'placeholder' => 'Unit Price']) */ ?>

    <?php /* echo $form->field($model, 'discount_amt')->textInput(['maxlength' => true, 'placeholder' => 'Discount Amt']) */ ?>

    <?php /* echo $form->field($model, 'discount_pct')->textInput(['maxlength' => true, 'placeholder' => 'Discount Pct']) */ ?>

    <?php /* echo $form->field($model, 'recycling_amt')->textInput(['maxlength' => true, 'placeholder' => 'Recycling Amt']) */ ?>

    <?php /* echo $form->field($model, 'ship_amt')->textInput(['maxlength' => true, 'placeholder' => 'Ship Amt']) */ ?>

    <?php /* echo $form->field($model, 'shiptax_amt')->textInput(['maxlength' => true, 'placeholder' => 'Shiptax Amt']) */ ?>

    <?php /* echo $form->field($model, 'unit_tax')->textInput(['maxlength' => true, 'placeholder' => 'Unit Tax']) */ ?>

    <?php /* echo $form->field($model, 'unit_tax_pct')->textInput(['maxlength' => true, 'placeholder' => 'Unit Tax Pct']) */ ?>

    <?php /* echo $form->field($model, 'vat_pct')->textInput(['maxlength' => true, 'placeholder' => 'Vat Pct']) */ ?>

    <?php /* echo $form->field($model, 'quantity')->textInput(['placeholder' => 'Quantity']) */ ?>

    <?php /* echo $form->field($model, 'item_type')->dropDownList([ 'ship' => 'Ship', 'advisory' => 'Advisory', 'instore' => 'Instore', ], ['prompt' => '']) */ ?>

    <?php /* echo $form->field($model, 'status')->textInput(['maxlength' => true, 'placeholder' => 'Status']) */ ?>

    <?php /* echo $form->field($model, 'last_mp_updated')->textInput(['placeholder' => 'Last Mp Updated']) */ ?>

    <?php /* echo $form->field($model, 'mp_item_id')->textInput(['maxlength' => true, 'placeholder' => 'Mp Item']) */ ?>

    <?php /* echo $form->field($model, 'extra_info')->textInput(['maxlength' => true, 'placeholder' => 'Extra Info']) */ ?>

    <?php /* echo $form->field($model, 'created_at')->widget(\kartik\datecontrol\DateControl::classname(), [
        'type' => \kartik\datecontrol\DateControl::FORMAT_DATETIME,
        'saveFormat' => 'php:Y-m-d H:i:s',
        'ajaxConversion' => true,
        'options' => [
            'pluginOptions' => [
                'placeholder' => 'Choose Created At',
                'autoclose' => true,
            ]
        ],
    ]); */ ?>

    <?php /* echo $form->field($model, 'updated_at')->widget(\kartik\datecontrol\DateControl::classname(), [
        'type' => \kartik\datecontrol\DateControl::FORMAT_DATETIME,
        'saveFormat' => 'php:Y-m-d H:i:s',
        'ajaxConversion' => true,
        'options' => [
            'pluginOptions' => [
                'placeholder' => 'Choose Updated At',
                'autoclose' => true,
            ]
        ],
    ]); */ ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
