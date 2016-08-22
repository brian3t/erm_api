<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\base\User */
/* @var $form yii\widgets\ActiveForm */

\mootensai\components\JsBlock::widget(['viewFile' => '_script', 'pos'=> \yii\web\View::POS_END, 
    'viewParams' => [
        'class' => 'SocialAccount', 
        'relID' => 'social-account', 
        'value' => \yii\helpers\Json::encode($model->socialAccounts),
        'isNewRecord' => ($model->isNewRecord) ? 1 : 0
    ]
]);
\mootensai\components\JsBlock::widget(['viewFile' => '_script', 'pos'=> \yii\web\View::POS_END, 
    'viewParams' => [
        'class' => 'Token', 
        'relID' => 'token', 
        'value' => \yii\helpers\Json::encode($model->tokens),
        'isNewRecord' => ($model->isNewRecord) ? 1 : 0
    ]
]);
?>

<div class="user-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->errorSummary($model); ?>

    <?= $form->field($model, 'id', ['template' => '{input}'])->textInput(['style' => 'display:none']); ?>

    <?= $form->field($model, 'username')->textInput(['maxlength' => true, 'placeholder' => 'Username']) ?>

    <?= $form->field($model, 'company_id')->widget(\kartik\widgets\Select2::classname(), [
        'data' => \yii\helpers\ArrayHelper::map(\app\models\base\Company::find()->orderBy('id')->asArray()->all(), 'id', 'name'),
        'options' => ['placeholder' => 'Choose Company'],
        'pluginOptions' => [
            'allowClear' => true
        ],
    ]); ?>

    <?= $form->field($model, 'email')->textInput(['maxlength' => true, 'placeholder' => 'Email']) ?>

    <?= $form->field($model, 'password_hash')->textInput(['maxlength' => true, 'placeholder' => 'Password Hash']) ?>

    <?= $form->field($model, 'auth_key')->textInput(['maxlength' => true, 'placeholder' => 'Auth Key']) ?>

    <?= $form->field($model, 'confirmed_at')->textInput(['placeholder' => 'Confirmed At']) ?>

    <?= $form->field($model, 'unconfirmed_email')->textInput(['maxlength' => true, 'placeholder' => 'Unconfirmed Email']) ?>

    <?= $form->field($model, 'blocked_at')->textInput(['placeholder' => 'Blocked At']) ?>

    <?= $form->field($model, 'registration_ip')->textInput(['maxlength' => true, 'placeholder' => 'Registration Ip']) ?>

    <?= $form->field($model, 'created_at')->textInput(['placeholder' => 'Created At']) ?>

    <?= $form->field($model, 'updated_at')->textInput(['placeholder' => 'Updated At']) ?>

    <?= $form->field($model, 'flags')->textInput(['placeholder' => 'Flags']) ?>

    <?= $form->field($model, 'first_name')->textInput(['maxlength' => true, 'placeholder' => 'First Name']) ?>

    <?= $form->field($model, 'last_name')->textInput(['maxlength' => true, 'placeholder' => 'Last Name']) ?>

    <?= $form->field($model, 'job_title')->textInput(['maxlength' => true, 'placeholder' => 'Job Title']) ?>

    <?= $form->field($model, 'line_of_business')->dropDownList([ 'Management' => 'Management', 'Agency' => 'Agency', 'Promotion' => 'Promotion', 'Venue' => 'Venue', 'Network' => 'Network', 'Studio' => 'Studio', 'Public Relations' => 'Public Relations', 'Consulting' => 'Consulting', 'Talent' => 'Talent', 'Client' => 'Client', 'Production Company' => 'Production Company', 'Photography' => 'Photography', 'Editing' => 'Editing', 'Business Management' => 'Business Management', 'Tour Management' => 'Tour Management', 'Personal' => 'Personal', 'Other' => 'Other', ], ['prompt' => '']) ?>

    <?= $form->field($model, 'union_memberships')->dropDownList([ 'SAG-AFTRA' => 'SAG-AFTRA', 'WGAW' => 'WGAW', 'Directors Guild of America' => 'Directors Guild of America', 'ATA' => 'ATA', 'Producers Guild of America' => 'Producers Guild of America', 'AMPTP' => 'AMPTP', 'ASCAP' => 'ASCAP', 'I.A.T.S.E.' => 'I.A.T.S.E.', 'International Cinematographers Guild' => 'International Cinematographers Guild', 'Teamsters Union 399' => 'Teamsters Union 399', 'MPEG' => 'MPEG', 'Annimation Guild' => 'Annimation Guild', 'Motion Picture Sound Editors' => 'Motion Picture Sound Editors', 'Other' => 'Other', ], ['prompt' => '']) ?>

    <?= $form->field($model, 'phone_number_type')->dropDownList([ 'Home' => 'Home', 'Business' => 'Business', 'Cell' => 'Cell', 'Fax' => 'Fax', 'Other' => 'Other', ], ['prompt' => '']) ?>

    <?= $form->field($model, 'phone_number')->textInput(['maxlength' => true, 'placeholder' => 'Phone Number']) ?>

    <?= $form->field($model, 'birthdate')->widget(\kartik\datecontrol\DateControl::classname(), [
        'type' => \kartik\datecontrol\DateControl::FORMAT_DATE,
        'saveFormat' => 'php:Y-m-d',
        'ajaxConversion' => true,
        'options' => [
            'pluginOptions' => [
                'placeholder' => 'Choose Birthdate',
                'autoclose' => true
            ]
        ],
    ]); ?>

    <?= $form->field($model, 'website_url')->textInput(['maxlength' => true, 'placeholder' => 'Website Url']) ?>

    <?= $form->field($model, 'twitter_id')->textInput(['maxlength' => true, 'placeholder' => 'Twitter']) ?>

    <?= $form->field($model, 'facebook_id')->textInput(['maxlength' => true, 'placeholder' => 'Facebook']) ?>

    <?= $form->field($model, 'instagram_id')->textInput(['maxlength' => true, 'placeholder' => 'Instagram']) ?>

    <?= $form->field($model, 'google_id')->textInput(['maxlength' => true, 'placeholder' => 'Google']) ?>

    <?= $form->field($model, 'yahoo_id')->textInput(['maxlength' => true, 'placeholder' => 'Yahoo']) ?>

    <?= $form->field($model, 'linkedin_id')->textInput(['maxlength' => true, 'placeholder' => 'Linkedin']) ?>

    <?php
    // $forms = [
    //     [
    //         'label' => '<i class="glyphicon glyphicon-book"></i> ' . Html::encode('Profile'),
    //         'content' => $this->render('_formProfile', [
    //             'form' => $form,
    //             'Profile' => is_null($model->profile) ? new app\models\base\Profile() : $model->profile,
    //         ]),
    //     ],
    //     [
    //         'label' => '<i class="glyphicon glyphicon-book"></i> ' . Html::encode('SocialAccount'),
    //         'content' => $this->render('_formSocialAccount', [
    //             'row' => \yii\helpers\ArrayHelper::toArray($model->socialAccounts),
    //         ]),
    //     ],
    //     [
    //         'label' => '<i class="glyphicon glyphicon-book"></i> ' . Html::encode('Token'),
    //         'content' => $this->render('_formToken', [
    //             'row' => \yii\helpers\ArrayHelper::toArray($model->tokens),
    //         ]),
    //     ],
    // ];
    // echo kartik\tabs\TabsX::widget([
    //     'items' => $forms,
    //     'position' => kartik\tabs\TabsX::POS_ABOVE,
    //     'encodeLabels' => false,
    //     'pluginOptions' => [
    //         'bordered' => true,
    //         'sideways' => true,
    //         'enableCache' => false,
    //     ],
    // ]);
    ?>
    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
        <?= Html::a(Yii::t('app', 'Cancel'), Yii::$app->request->referrer , ['class'=> 'btn btn-danger']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
