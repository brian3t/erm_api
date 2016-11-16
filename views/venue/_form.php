<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Venue */
/* @var $form yii\widgets\ActiveForm */

?>

<div class="venue-form">

    <?php $form=ActiveForm::begin(); ?>

    <?= $form->errorSummary($model); ?>

    <?= $form->field($model,'id',['template'=>'{input}'])->textInput(['style'=>'display:none']); ?>

    <?= $form->field($model,'name')->textInput(['maxlength'=>true,'placeholder'=>'Name']) ?>

    <?= $form->field($model,'venue_type')->dropDownList([''=>'','Amphitheater'=>'Amphitheater','Arena'=>'Arena','Bandshell'=>'Bandshell','Club'=>'Club','College'=>'College','Concert Hall'=>'Concert Hall','Operahouse'=>'Operahouse','Other'=>'Other','Private'=>'Private','Stadium'=>'Stadium','Theater'=>'Theater']) ?>

    <?= $form->field($model,'created_at')->widget(\kartik\datecontrol\DateControl::classname(),[
        'type'=>\kartik\datecontrol\DateControl::FORMAT_DATETIME,
        'saveFormat'=>'php:Y-m-d H:i:s',
        'ajaxConversion'=>true,
        'options'=>[
            'pluginOptions'=>[
                'placeholder'=>'Choose Created At',
                'autoclose'=>true,
            ]
        ],
    ]); ?>

    <?= $form->field($model,'updated_at')->widget(\kartik\datecontrol\DateControl::classname(),[
        'type'=>\kartik\datecontrol\DateControl::FORMAT_DATETIME,
        'saveFormat'=>'php:Y-m-d H:i:s',
        'ajaxConversion'=>true,
        'options'=>[
            'pluginOptions'=>[
                'placeholder'=>'Choose Updated At',
                'autoclose'=>true,
            ]
        ],
    ]); ?>

    <?= $form->field($model,'previous_name')->textInput(['maxlength'=>true,'placeholder'=>'Previous Name']) ?>

    <?= $form->field($model,'note')->textarea(['maxlength'=>true,'placeholder'=>'Note']) ?>

    <?= $form->field($model,'ticket_rebate')->textarea(['maxlength'=>true,'placeholder'=>'Ticket Rebate']) ?>

    <?= $form->field($model,'other_deal')->textarea(['maxlength'=>true,'placeholder'=>'Other Deal']) ?>

    <?= $form->field($model,'address1')->textInput(['maxlength'=>true,'placeholder'=>'Address1']) ?>

    <?= $form->field($model,'address2')->textInput(['maxlength'=>true,'placeholder'=>'Address2']) ?>

    <?= $form->field($model,'city')->textInput(['maxlength'=>true,'placeholder'=>'City']) ?>

    <?= $form->field($model,'state')->textInput(['maxlength'=>true,'placeholder'=>'State']) ?>

    <?= $form->field($model,'zipcode')->textInput(['maxlength'=>true,'placeholder'=>'Zipcode']) ?>

    <?= $form->field($model,'country')->textInput(['maxlength'=>true,'placeholder'=>'Country']) ?>

    <?= $form->field($model,'timezone')->dropDownList([''=>'',
        'ACDT Australian Central Daylight Savings Time'=>'ACDT Australian Central Daylight Savings Time',
        'ACST Australian Central Standard Time'=>'ACST Australian Central Standard Time',
        'ACT Acre Time'=>'ACT Acre Time','ACT ASEAN Common Time'=>'ACT ASEAN Common Time',
        'ADT Atlantic Daylight Time'=>'ADT Atlantic Daylight Time',
        'AEDT Australian Eastern Daylight Savings Time'=>'AEDT Australian Eastern Daylight Savings Time',
        'AEST Australian Eastern Standard Time'=>'AEST Australian Eastern Standard Time',
        'AFT Afghanistan Time'=>'AFT Afghanistan Time','AKDT Alaska Daylight Time'=>'AKDT Alaska Daylight Time',
        'AKST Alaska Standard Time'=>'AKST Alaska Standard Time','AMST Amazon Summer Time (Brazil'=>'AMST Amazon Summer Time (Brazil']) ?>

    <?= $form->field($model,'owner')->textInput(['maxlength'=>true,'placeholder'=>'Owner']) ?>

    <?= $form->field($model,'company_id')->widget(\kartik\widgets\Select2::classname(),[
        'data'=>\yii\helpers\ArrayHelper::map(\app\models\Company::find()->orderBy('id')->asArray()->all(),'id','name'),
        'options'=>['placeholder'=>'Choose Company'],
        'pluginOptions'=>[
            'allowClear'=>true
        ],
    ]); ?>

    <?= $form->field($model,'general_info_email')->textInput(['maxlength'=>true,'placeholder'=>'General Info Email']) ?>

    <?= $form->field($model,'main_office_phone')->textInput(['maxlength'=>true,'placeholder'=>'Main Office Phone']) ?>

    <?= $form->field($model,'box_office_phone')->textInput(['maxlength'=>true,'placeholder'=>'Box Office Phone']) ?>

    <?= $form->field($model,'fax_phone')->textInput(['maxlength'=>true,'placeholder'=>'Fax Phone']) ?>

    <?= $form->field($model,'other_phone')->textInput(['maxlength'=>true,'placeholder'=>'Other Phone']) ?>

    <?= $form->field($model,'primary_ticketing_company_id')->widget(\kartik\widgets\Select2::classname(),[
        'data'=>\yii\helpers\ArrayHelper::map(\app\models\Company::find()->orderBy('id')->asArray()->all(),'id','name'),
        'options'=>['placeholder'=>'Choose Company'],
        'pluginOptions'=>[
            'allowClear'=>true
        ],
    ]); ?>

    <?= $form->field($model,'other_seating_capacity')->textInput(['placeholder'=>'Other Seating Capacity']) ?>

    <?= $form->field($model,'end_stage_seating_capacity')->textInput(['placeholder'=>'End Stage Seating Capacity']) ?>

    <?= $form->field($model,'full_stage_seating_capacity')->textInput(['placeholder'=>'Full Stage Seating Capacity']) ?>

    <?= $form->field($model,'half_stage_seating_capacity')->textInput(['placeholder'=>'Half Stage Seating Capacity']) ?>

    <?= $form->field($model,'in_the_round_seating_capacity')->textInput(['placeholder'=>'In The Round Seating Capacity']) ?>

    <?= $form->field($model,'other_seating_capacity_name')->textInput(['placeholder'=>'Other Seating Capacity Name']) ?>

    <?= $form->field($model,'other_seating_capacity_value')->textInput(['placeholder'=>'Other Seating Capacity Value']) ?>

    <?= $form->field($model,'webpage')->textInput(['maxlength'=>true,'placeholder'=>'Webpage']) ?>

    <?= $form->field($model,'facebook')->textInput(['maxlength'=>true,'placeholder'=>'Facebook']) ?>

    <?= $form->field($model,'yahoo')->textInput(['maxlength'=>true,'placeholder'=>'Yahoo']) ?>

    <?= $form->field($model,'linkedin')->textInput(['maxlength'=>true,'placeholder'=>'Linkedin']) ?>

    <?= $form->field($model,'twitter')->textInput(['maxlength'=>true,'placeholder'=>'Twitter']) ?>

    <?= $form->field($model,'instagram')->textInput(['maxlength'=>true,'placeholder'=>'Instagram']) ?>

    <?= $form->field($model,'google')->textInput(['maxlength'=>true,'placeholder'=>'Google']) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update',['class'=>$model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
        <?= Html::a(Yii::t('app','Cancel'),Yii::$app->request->referrer,['class'=>'btn btn-danger']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
