<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\OrderItem */
/* @var $form yii\widgets\ActiveForm */

\mootensai\components\JsBlock::widget(['viewFile' => '_script', 'pos'=> \yii\web\View::POS_END, 
    'viewParams' => [
        'class' => 'OrderReturnItem', 
        'relID' => 'order-return-item', 
        'value' => \yii\helpers\Json::encode($model->orderReturnItems),
        'isNewRecord' => ($model->isNewRecord) ? 1 : 0
    ]
]);
\mootensai\components\JsBlock::widget(['viewFile' => '_script', 'pos'=> \yii\web\View::POS_END, 
    'viewParams' => [
        'class' => 'OrderShipmentPackageItem', 
        'relID' => 'order-shipment-package-item', 
        'value' => \yii\helpers\Json::encode($model->orderShipmentPackageItems),
        'isNewRecord' => ($model->isNewRecord) ? 1 : 0
    ]
]);
?>

<div class="order-item-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->errorSummary($model); ?>

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

    <?= $form->field($model, 'unit_price')->textInput(['maxlength' => true, 'placeholder' => 'Unit Price']) ?>

    <?= $form->field($model, 'discount_amt')->textInput(['maxlength' => true, 'placeholder' => 'Discount Amt']) ?>

    <?= $form->field($model, 'discount_pct')->textInput(['maxlength' => true, 'placeholder' => 'Discount Pct']) ?>

    <?= $form->field($model, 'recycling_amt')->textInput(['maxlength' => true, 'placeholder' => 'Recycling Amt']) ?>

    <?= $form->field($model, 'ship_amt')->textInput(['maxlength' => true, 'placeholder' => 'Ship Amt']) ?>

    <?= $form->field($model, 'shiptax_amt')->textInput(['maxlength' => true, 'placeholder' => 'Shiptax Amt']) ?>

    <?= $form->field($model, 'unit_tax')->textInput(['maxlength' => true, 'placeholder' => 'Unit Tax']) ?>

    <?= $form->field($model, 'unit_tax_pct')->textInput(['maxlength' => true, 'placeholder' => 'Unit Tax Pct']) ?>

    <?= $form->field($model, 'vat_pct')->textInput(['maxlength' => true, 'placeholder' => 'Vat Pct']) ?>

    <?= $form->field($model, 'quantity')->textInput(['placeholder' => 'Quantity']) ?>

    <?= $form->field($model, 'item_type')->dropDownList([ 'ship' => 'Ship', 'advisory' => 'Advisory', 'instore' => 'Instore', ], ['prompt' => '']) ?>

    <?= $form->field($model, 'status')->textInput(['maxlength' => true, 'placeholder' => 'Status']) ?>

    <?= $form->field($model, 'last_mp_updated')->textInput(['placeholder' => 'Last Mp Updated']) ?>

    <?= $form->field($model, 'mp_item_id')->textInput(['maxlength' => true, 'placeholder' => 'Mp Item']) ?>

    <?= $form->field($model, 'extra_info')->textInput(['maxlength' => true, 'placeholder' => 'Extra Info']) ?>

    <?= $form->field($model, 'created_at')->widget(\kartik\datecontrol\DateControl::classname(), [
        'type' => \kartik\datecontrol\DateControl::FORMAT_DATETIME,
        'saveFormat' => 'php:Y-m-d H:i:s',
        'ajaxConversion' => true,
        'options' => [
            'pluginOptions' => [
                'placeholder' => 'Choose Created At',
                'autoclose' => true,
            ]
        ],
    ]); ?>

    <?= $form->field($model, 'updated_at')->widget(\kartik\datecontrol\DateControl::classname(), [
        'type' => \kartik\datecontrol\DateControl::FORMAT_DATETIME,
        'saveFormat' => 'php:Y-m-d H:i:s',
        'ajaxConversion' => true,
        'options' => [
            'pluginOptions' => [
                'placeholder' => 'Choose Updated At',
                'autoclose' => true,
            ]
        ],
    ]); ?>

    <?php
    $forms = [
        [
            'label' => '<i class="glyphicon glyphicon-book"></i> ' . Html::encode('OrderReturnItem'),
            'content' => $this->render('_formOrderReturnItem', [
                'row' => \yii\helpers\ArrayHelper::toArray($model->orderReturnItems),
            ]),
        ],
        [
            'label' => '<i class="glyphicon glyphicon-book"></i> ' . Html::encode('OrderShipmentPackageItem'),
            'content' => $this->render('_formOrderShipmentPackageItem', [
                'row' => \yii\helpers\ArrayHelper::toArray($model->orderShipmentPackageItems),
            ]),
        ],
    ];
    echo kartik\tabs\TabsX::widget([
        'items' => $forms,
        'position' => kartik\tabs\TabsX::POS_ABOVE,
        'encodeLabels' => false,
        'pluginOptions' => [
            'bordered' => true,
            'sideways' => true,
            'enableCache' => false,
        ],
    ]);
    ?>
    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
