<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\OrderSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="form-order-search">

    <?php $form = ActiveForm::begin([
        'action' => array_merge(['index'],
            Yii::$app->request->getQueryParams()),
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id', ['template' => '{input}'])->textInput(['style' => 'display:none']); ?>

    <?= $form->field($model, 'mp_id')->widget(\kartik\widgets\Select2::classname(), [
        'data' => \yii\helpers\ArrayHelper::map(\app\models\Mp::find()->orderBy('id')->asArray()->all(), 'id', 'name'),
        'options' => ['placeholder' => 'Choose Mp'],
        'pluginOptions' => [
            'allowClear' => true
        ],
    ]) ?>

    <?= $form->field($model, 'mp_reference_number')->textInput(['maxlength' => true, 'placeholder' => 'Mp Reference Number']) ?>

    <?= $form->field($model, 'rop_order_id')->textInput(['placeholder' => 'Rop Order']) ?>

    <?= $form->field($model, 'last_mp_updated')->textInput(['placeholder' => 'Last Mp Updated']) ?>

    <?php /* echo $form->field($model, 'last_rop_pull')->textInput(['placeholder' => 'Last Rop Pull']) */ ?>

    <?php /* echo $form->field($model, 'force_rop_resend')->textInput(['placeholder' => 'Force Rop Resend']) */ ?>

    <?php /* echo $form->field($model, 'count_rop_pull')->textInput(['placeholder' => 'Count Rop Pull']) */ ?>

    <?php /* echo $form->field($model, 'order_date_time')->widget(\kartik\widgets\DateTimePicker::classname(), [
        'options' => ['placeholder' => 'Choose Order Date Time'],
        'pluginOptions' => [
            'autoclose' => true,
            'format' => 'mm/dd/yyyy hh:ii:ss'
        ]
    ]) */ ?>

    <?php /* echo $form->field($model, 'name')->textInput(['maxlength' => true, 'placeholder' => 'Name']) */ ?>

    <?php /* echo $form->field($model, 'company')->textInput(['maxlength' => true, 'placeholder' => 'Company']) */ ?>

    <?php /* echo $form->field($model, 'email')->textInput(['maxlength' => true, 'placeholder' => 'Email']) */ ?>

    <?php /* echo $form->field($model, 'address')->textInput(['maxlength' => true, 'placeholder' => 'Address']) */ ?>

    <?php /* echo $form->field($model, 'address2')->textInput(['maxlength' => true, 'placeholder' => 'Address2']) */ ?>

    <?php /* echo $form->field($model, 'city')->textInput(['maxlength' => true, 'placeholder' => 'City']) */ ?>

    <?php /* echo $form->field($model, 'state')->textInput(['maxlength' => true, 'placeholder' => 'State']) */ ?>

    <?php /* echo $form->field($model, 'zip')->textInput(['maxlength' => true, 'placeholder' => 'Zip']) */ ?>

    <?php /* echo $form->field($model, 'country')->textInput(['maxlength' => true, 'placeholder' => 'Country']) */ ?>

    <?php /* echo $form->field($model, 'phone')->textInput(['maxlength' => true, 'placeholder' => 'Phone']) */ ?>

    <?php /* echo $form->field($model, 'ship_name')->textInput(['maxlength' => true, 'placeholder' => 'Ship Name']) */ ?>

    <?php /* echo $form->field($model, 'ship_company')->textInput(['maxlength' => true, 'placeholder' => 'Ship Company']) */ ?>

    <?php /* echo $form->field($model, 'ship_address')->textInput(['maxlength' => true, 'placeholder' => 'Ship Address']) */ ?>

    <?php /* echo $form->field($model, 'ship_address2')->textInput(['maxlength' => true, 'placeholder' => 'Ship Address2']) */ ?>

    <?php /* echo $form->field($model, 'ship_city')->textInput(['maxlength' => true, 'placeholder' => 'Ship City']) */ ?>

    <?php /* echo $form->field($model, 'ship_state')->textInput(['maxlength' => true, 'placeholder' => 'Ship State']) */ ?>

    <?php /* echo $form->field($model, 'ship_zip')->textInput(['maxlength' => true, 'placeholder' => 'Ship Zip']) */ ?>

    <?php /* echo $form->field($model, 'ship_country')->textInput(['maxlength' => true, 'placeholder' => 'Ship Country']) */ ?>

    <?php /* echo $form->field($model, 'ship_phone')->textInput(['maxlength' => true, 'placeholder' => 'Ship Phone']) */ ?>

    <?php /* echo $form->field($model, 'pay_type')->textInput(['maxlength' => true, 'placeholder' => 'Pay Type']) */ ?>

    <?php /* echo $form->field($model, 'pay_transaction_id')->textInput(['maxlength' => true, 'placeholder' => 'Pay Transaction']) */ ?>

    <?php /* echo $form->field($model, 'comments')->textarea(['rows' => 6]) */ ?>

    <?php /* echo $form->field($model, 'product_total')->textInput(['maxlength' => true, 'placeholder' => 'Product Total']) */ ?>

    <?php /* echo $form->field($model, 'tax_total')->textInput(['maxlength' => true, 'placeholder' => 'Tax Total']) */ ?>

    <?php /* echo $form->field($model, 'shipping_total')->textInput(['maxlength' => true, 'placeholder' => 'Shipping Total']) */ ?>

    <?php /* echo $form->field($model, 'grand_total')->textInput(['maxlength' => true, 'placeholder' => 'Grand Total']) */ ?>

    <?php /* echo $form->field($model, 'shipping')->textInput(['maxlength' => true, 'placeholder' => 'Shipping']) */ ?>

    <?php /* echo $form->field($model, 'discount')->textInput(['maxlength' => true, 'placeholder' => 'Discount']) */ ?>

    <?php /* echo $form->field($model, 'status')->textInput(['maxlength' => true, 'placeholder' => 'Status']) */ ?>

    <?php /* echo $form->field($model, 'note')->textInput(['maxlength' => true, 'placeholder' => 'Note']) */ ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
