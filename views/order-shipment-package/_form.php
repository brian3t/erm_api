<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\OrderShipmentPackage */
/* @var $form yii\widgets\ActiveForm */

\mootensai\components\JsBlock::widget(['viewFile' => '_script', 'pos'=> \yii\web\View::POS_END, 
    'viewParams' => [
        'class' => 'OrderShipmentPackageItem', 
        'relID' => 'order-shipment-package-item', 
        'value' => \yii\helpers\Json::encode($model->orderShipmentPackageItems),
        'isNewRecord' => ($model->isNewRecord) ? 1 : 0
    ]
]);
?>

<div class="order-shipment-package-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->errorSummary($model); ?>

    <?= $form->field($model, 'id', ['template' => '{input}'])->textInput(['style' => 'display:none']); ?>

    <?= $form->field($model, 'order_shipment_id')->widget(\kartik\widgets\Select2::classname(), [
        'data' => \yii\helpers\ArrayHelper::map(\app\models\OrderShipment::find()->orderBy('id')->asArray()->all(), 'id', 'id'),
        'options' => ['placeholder' => 'Choose Order shipment'],
        'pluginOptions' => [
            'allowClear' => true
        ],
    ]); ?>

    <?= $form->field($model, 'retailops_package_id')->textInput(['placeholder' => 'Retailops Package']) ?>

    <?= $form->field($model, 'carrier_name')->textInput(['maxlength' => true, 'placeholder' => 'Carrier Name']) ?>

    <?= $form->field($model, 'carrier_class_name')->textInput(['maxlength' => true, 'placeholder' => 'Carrier Class Name']) ?>

    <?= $form->field($model, 'channel_ship_code')->textInput(['maxlength' => true, 'placeholder' => 'Channel Ship Code']) ?>

    <?= $form->field($model, 'tracking_number')->textInput(['maxlength' => true, 'placeholder' => 'Tracking Number']) ?>

    <?= $form->field($model, 'weight_kg')->textInput(['placeholder' => 'Weight Kg']) ?>

    <?= $form->field($model, 'date_shipped')->widget(\kartik\datecontrol\DateControl::classname(), [
        'type' => \kartik\datecontrol\DateControl::FORMAT_DATETIME,
        'saveFormat' => 'php:Y-m-d H:i:s',
        'ajaxConversion' => true,
        'options' => [
            'pluginOptions' => [
                'placeholder' => 'Choose Date Shipped',
                'autoclose' => true,
            ]
        ],
    ]); ?>

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
        <?= Html::a(Yii::t('app', 'Cancel'), Yii::$app->request->referrer , ['class'=> 'btn btn-danger']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
