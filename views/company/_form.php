<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Company */
/* @var $form yii\widgets\ActiveForm */

\mootensai\components\JsBlock::widget(['viewFile' => '_script', 'pos'=> \yii\web\View::POS_END, 
    'viewParams' => [
        'class' => 'CompanyUser', 
        'relID' => 'company-user', 
        'value' => \yii\helpers\Json::encode($model->companyUsers),
        'isNewRecord' => ($model->isNewRecord) ? 1 : 0
    ]
]);
?>

<div class="company-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->errorSummary($model); ?>

    <?= $form->field($model, 'id', ['template' => '{input}'])->textInput(['style' => 'display:none']); ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true, 'placeholder' => 'Name']) ?>

    <?= $form->field($model, 'website')->textInput(['maxlength' => true, 'placeholder' => 'Website']) ?>

    <?= $form->field($model, 'headline')->textInput(['maxlength' => true, 'placeholder' => 'Headline']) ?>

    <?= $form->field($model, 'industry')->textInput(['maxlength' => true, 'placeholder' => 'Industry']) ?>

    <?= $form->field($model, 'phone_number')->textInput(['maxlength' => true, 'placeholder' => 'Phone Number']) ?>

    <?= $form->field($model, 'city')->textInput(['maxlength' => true, 'placeholder' => 'City']) ?>

    <?= $form->field($model, 'state')->textInput(['maxlength' => true, 'placeholder' => 'State']) ?>

    <?= $form->field($model, 'postal_code')->textInput(['maxlength' => true, 'placeholder' => 'Postal Code']) ?>

    <?= $form->field($model, 'num_of_employee')->textInput(['maxlength' => true, 'placeholder' => 'Num Of Employee']) ?>

    <?= $form->field($model, 'annual_revenue')->textInput(['placeholder' => 'Annual Revenue']) ?>

    <?= $form->field($model, 'facebook_fans')->textInput(['placeholder' => 'Facebook Fans']) ?>

    <?= $form->field($model, 'twitter_handle')->textInput(['maxlength' => true, 'placeholder' => 'Twiiter Handle']) ?>

    <?= $form->field($model, 'twitter_followers')->textInput(['placeholder' => 'Twitter Followers']) ?>

    <?= $form->field($model, 'linkedin_company_page')->textInput(['maxlength' => true, 'placeholder' => 'Linkedin Company Page']) ?>

    <?= $form->field($model, 'timezone')->dropDownList([ 'PST' => 'PST', 'CST' => 'CST', 'MST' => 'MST', 'EST' => 'EST', 'UTC' => 'UTC', ], ['prompt' => '']) ?>

    <?= $form->field($model, 'description')->textInput(['maxlength' => true, 'placeholder' => 'Description']) ?>

    <?= $form->field($model, 'line_of_business')->textInput(['maxlength' => true, 'placeholder' => 'Line Of Business']) ?>

    <?php
    $forms = [
        [
            'label' => '<i class="glyphicon glyphicon-book"></i> ' . Html::encode('CompanyUser'),
            'content' => $this->render('_formCompanyUser', [
                'row' => \yii\helpers\ArrayHelper::toArray($model->companyUsers),
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
