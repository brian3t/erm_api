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
        'class' => 'MkMisc', 
        'relID' => 'mk-misc', 
        'value' => \yii\helpers\Json::encode($model->mkMiscs),
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
        'class' => 'MkProduction', 
        'relID' => 'mk-production', 
        'value' => \yii\helpers\Json::encode($model->mkProductions),
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

    <?= $form->field($model, 'budget')->textInput(['maxlength' => true, 'placeholder' => 'Budget']) ?>

    <?= $form->field($model, 'note')->textInput(['maxlength' => true, 'placeholder' => 'Note']) ?>

    <?php
    $forms = [
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
            'label' => '<i class="glyphicon glyphicon-book"></i> ' . Html::encode('MkInternet'),
            'content' => $this->render('_formMkInternet', [
                'row' => \yii\helpers\ArrayHelper::toArray($model->mkInternets),
            ]),
        ],
        [
            'label' => '<i class="glyphicon glyphicon-book"></i> ' . Html::encode('MkPrint'),
            'content' => $this->render('_formMkPrint', [
                'row' => \yii\helpers\ArrayHelper::toArray($model->mkPrints),
            ]),
        ],
        [
            'label' => '<i class="glyphicon glyphicon-book"></i> ' . Html::encode('MkProduction'),
            'content' => $this->render('_formMkProduction', [
                'row' => \yii\helpers\ArrayHelper::toArray($model->mkProductions),
            ]),
        ],
		[
            'label' => '<i class="glyphicon glyphicon-book"></i> ' . Html::encode('MkMisc'),
            'content' => $this->render('_formMkMisc', [
                'row' => \yii\helpers\ArrayHelper::toArray($model->mkMiscs),
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
