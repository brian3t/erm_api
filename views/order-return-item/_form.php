<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\OrderReturnItem */
/* @var $form yii\widgets\ActiveForm */

?>

<div class="order-return-item-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->errorSummary($model); ?>

    <?= $form->field($model, 'id', ['template' => '{input}'])->textInput(['style' => 'display:none']); ?>

    <?= $form->field($model, 'order_return_id')->widget(\kartik\widgets\Select2::classname(), [
        'data' => \yii\helpers\ArrayHelper::map(\app\models\OrderReturn::find()->orderBy('id')->asArray()->all(), 'id', 'id'),
        'options' => ['placeholder' => 'Choose Order return'],
        'pluginOptions' => [
            'allowClear' => true
        ],
    ]); ?>

    <?= $form->field($model, 'retailops_item_id')->textInput(['placeholder' => 'Retailops Item']) ?>

    <?= $form->field($model, 'channel_item_refnum')->textInput(['maxlength' => true, 'placeholder' => 'Channel Item Refnum']) ?>

    <?= $form->field($model, 'sku')->widget(\kartik\widgets\Select2::classname(), [
        'data' => \yii\helpers\ArrayHelper::map(\app\models\OrderItem::find()->orderBy('sku')->asArray()->all(), 'sku', 'id'),
        'options' => ['placeholder' => 'Choose Order item'],
        'pluginOptions' => [
            'allowClear' => true
        ],
    ]); ?>

    <?= $form->field($model, 'quantity')->textInput(['placeholder' => 'Quantity']) ?>

    <?= $form->field($model, 'reason')->textInput(['maxlength' => true, 'placeholder' => 'Reason']) ?>

    <?= $form->field($model, 'item_shipping_tax_amt')->textInput(['placeholder' => 'Item Shipping Tax Amt']) ?>

    <?= $form->field($model, 'tax_amt')->textInput(['placeholder' => 'Tax Amt']) ?>

    <?= $form->field($model, 'shipping_amt')->textInput(['placeholder' => 'Shipping Amt']) ?>

    <?= $form->field($model, 'restock_fee_amt')->textInput(['placeholder' => 'Restock Fee Amt']) ?>

    <?= $form->field($model, 'giftwrap_amt')->textInput(['placeholder' => 'Giftwrap Amt']) ?>

    <?= $form->field($model, 'giftwrap_tax_amt')->textInput(['placeholder' => 'Giftwrap Tax Amt']) ?>

    <?= $form->field($model, 'product_amt')->textInput(['placeholder' => 'Product Amt']) ?>

    <?= $form->field($model, 'recycling_amt')->textInput(['placeholder' => 'Recycling Amt']) ?>

    <?= $form->field($model, 'subtotal_amt')->textInput(['placeholder' => 'Subtotal Amt']) ?>

    <?= $form->field($model, 'credit_amt')->textInput(['placeholder' => 'Credit Amt']) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
        <?= Html::a(Yii::t('app', 'Cancel'), Yii::$app->request->referrer , ['class'=> 'btn btn-danger']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
