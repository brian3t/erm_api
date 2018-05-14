<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Marketing */
/* @var $form yii\widgets\ActiveForm */

\mootensai\components\JsBlock::widget(['viewFile' => '_script', 'pos'=> \yii\web\View::POS_END, 
    'viewParams' => [
        'class' => 'MkInternet', 
        'relID' => 'mk-internet', 
        'value' => \yii\helpers\Json::encode($model->mkInternets),
        'isNewRecord' => ($model->isNewRecord) ? 1 : 0
    ]
]);
\mootensai\components\JsBlock::widget(['viewFile' => '_script', 'pos'=> \yii\web\View::POS_END,  
   'viewParams' => [ 
       'class' => 'MkPrint',  
       'relID' => 'mk-print',  
       'value' => \yii\helpers\Json::encode($model->mkPrints), 
       'isNewRecord' => ($model->isNewRecord) ? 1 : 0
   ]
]);
\mootensai\components\JsBlock::widget(['viewFile' => '_script', 'pos'=> \yii\web\View::POS_END, 
    'viewParams' => [
        'class' => 'MkRadio', 
        'relID' => 'mk-radio', 
        'value' => \yii\helpers\Json::encode($model->mkRadios),
        'isNewRecord' => ($model->isNewRecord) ? 1 : 0
    ]
]);
\mootensai\components\JsBlock::widget(['viewFile' => '_script', 'pos'=> \yii\web\View::POS_END, 
    'viewParams' => [
        'class' => 'MkTelevision', 
        'relID' => 'mk-television', 
        'value' => \yii\helpers\Json::encode($model->mkTelevisions),
        'isNewRecord' => ($model->isNewRecord) ? 1 : 0
    ]
]);
?>

<div class="marketing-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->errorSummary($model); ?>

    <?= $form->field($model, 'id', ['template' => '{input}'])->textInput(['style' => 'display:none']); ?>

    <?= $form->field($model, 'offer_id')->widget(\kartik\widgets\Select2::classname(), [
        'data' => \yii\helpers\ArrayHelper::map(\app\models\Offer::find()->orderBy('id')->asArray()->all(), 'id', 'event_id'),
        'options' => ['placeholder' => 'Choose Offer'],
        'pluginOptions' => [
            'allowClear' => true
        ],
    ]); ?>

    <?= $form->field($model, 'user_id')->widget(\kartik\widgets\Select2::classname(), [
        'data' => \yii\helpers\ArrayHelper::map(\app\models\User::find()->orderBy('id')->asArray()->all(), 'id', 'username'),
        'options' => ['placeholder' => 'Choose User'],
        'pluginOptions' => [
            'allowClear' => true
        ],
    ])->label('Created by'); ?>

    <?= $form->field($model, 'graphic_artist')->textInput(['maxlength' => true, 'placeholder' => 'Graphic Artist']) ?>

    <?= $form->field($model, 'newsprint')->textInput(['maxlength' => true, 'placeholder' => 'Newsprint']) ?>

    <?= $form->field($model, 'street_team')->textInput(['maxlength' => true, 'placeholder' => 'Street Team']) ?>

    <?= $form->field($model, 'billboards')->textInput(['maxlength' => true, 'placeholder' => 'Billboards']) ?>

    <?= $form->field($model, 'spots')->textInput(['maxlength' => true, 'placeholder' => 'Spots']) ?>

    <?= $form->field($model, 'admat')->textInput(['maxlength' => true, 'placeholder' => 'Admat']) ?>

    <?= $form->field($model, 'postage')->textInput(['maxlength' => true, 'placeholder' => 'Postage']) ?>

    <?= $form->field($model, 'others')->textInput(['maxlength' => true, 'placeholder' => 'Others']) ?>

    <?php
    $forms = [
        [
            'label' => '<i class="glyphicon glyphicon-book"></i> ' . Html::encode('MkInternet'),
            'content' => $this->render('_formMkInternet', [
                'row' => \yii\helpers\ArrayHelper::toArray($model->mkInternets),
            ]),
        ],
        [
            'label' => '<i class="glyphicon glyphicon-book"></i> ' . Html::encode('MkRadio'),
            'content' => $this->render('_formMkRadio', [
                'row' => \yii\helpers\ArrayHelper::toArray($model->mkRadios),
            ]),
        ],
        [
            'label' => '<i class="glyphicon glyphicon-book"></i> ' . Html::encode('MkTelevision'),
            'content' => $this->render('_formMkTelevision', [
                'row' => \yii\helpers\ArrayHelper::toArray($model->mkTelevisions),
            ]),
        ],
		[ 
           'label' => '<i class="glyphicon glyphicon-book"></i> ' . Html::encode('MkPrint'), 
           'content' => $this->render('_formMkPrint', [ 
               'row' => \yii\helpers\ArrayHelper::toArray($model->mkPrints), 
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
