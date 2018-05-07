<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Marketing */
/* @var $form yii\widgets\ActiveForm */

?>

<div class="marketing-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->errorSummary($model); ?>

    <?= $form->field($model, 'id', ['template' => '{input}'])->textInput(['style' => 'display:none']); ?>

    <?= $form->field($model, 'offer_id')->label('Event ID (Offer)')->widget(\kartik\widgets\Select2::classname(), [
        'data' => \yii\helpers\ArrayHelper::map(\app\models\Offer::find()->orderBy('id')->asArray()->all(), 'id', 'event_id'),
        'options' => ['placeholder' => 'Choose Event'],
        'pluginOptions' => [
            'allowClear' => true
        ],
    ]); ?>

    <?= $form->field($model, 'user_id')->label('Created By')->widget(\kartik\widgets\Select2::classname(), [
        'data' => \yii\helpers\ArrayHelper::map(\app\models\User::find()->orderBy('id')->asArray()->all(), 'id', 'username'),
        'options' => ['placeholder' => 'Choose User'],
        'pluginOptions' => [
            'allowClear' => true
        ],
    ]); ?>

    <?= $form->field($model, 'radio')->textInput(['maxlength' => true, 'placeholder' => 'Radio']) ?>

    <?= $form->field($model, 'tv')->textInput(['maxlength' => true, 'placeholder' => 'Tv']) ?>

    <?= $form->field($model, 'graphic_artist')->textInput(['maxlength' => true, 'placeholder' => 'Graphic Artist']) ?>

    <?= $form->field($model, 'newsprint')->textInput(['maxlength' => true, 'placeholder' => 'Newsprint']) ?>

    <?= $form->field($model, 'internet')->textInput(['maxlength' => true, 'placeholder' => 'Internet']) ?>

    <?= $form->field($model, 'street_team')->textInput(['maxlength' => true, 'placeholder' => 'Street Team']) ?>

    <?= $form->field($model, 'printing')->textInput(['maxlength' => true, 'placeholder' => 'Printing']) ?>

    <?= $form->field($model, 'billboards')->textInput(['maxlength' => true, 'placeholder' => 'Billboards']) ?>

    <?= $form->field($model, 'spots')->textInput(['maxlength' => true, 'placeholder' => 'Spots']) ?>

    <?= $form->field($model, 'admat')->textInput(['maxlength' => true, 'placeholder' => 'Admat']) ?>

    <?= $form->field($model, 'postage')->textInput(['maxlength' => true, 'placeholder' => 'Postage']) ?>

    <?= $form->field($model, 'others')->textInput(['maxlength' => true, 'placeholder' => 'Others']) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
