<div class="form-group" id="add-mk-print">
<?php
use kartik\grid\GridView;
use kartik\builder\TabularForm;
use yii\data\ArrayDataProvider;
use yii\helpers\Html;
use yii\widgets\Pjax;

$dataProvider = new ArrayDataProvider([
    'allModels' => $row,
    'pagination' => [
        'pageSize' => -1
    ]
]);
echo TabularForm::widget([
    'dataProvider' => $dataProvider,
    'formName' => 'MkPrint',
    'checkboxColumn' => false,
    'actionColumn' => false,
    'attributeDefaults' => [
        'type' => TabularForm::INPUT_TEXT,
    ],
    'attributes' => [
        "id" => ['type' => TabularForm::INPUT_HIDDEN, 'columnOptions' => ['hidden'=>true]],
        'company_id' => [
            'label' => 'Company',
            'type' => TabularForm::INPUT_WIDGET,
            'widgetClass' => \kartik\widgets\Select2::className(),
            'options' => [
                'data' => \yii\helpers\ArrayHelper::map(\app\models\Company::find()->orderBy('name')->asArray()->all(), 'id', 'name'),
                'options' => ['placeholder' => 'Choose Company'],
            ],
            'columnOptions' => ['width' => '200px']
        ],
        'print_media' => ['type' => TabularForm::INPUT_TEXT],
        'type' => ['type' => TabularForm::INPUT_TEXT],
        'contact' => ['type' => TabularForm::INPUT_TEXT],
        'phone_email' => ['type' => TabularForm::INPUT_TEXT],
        'size' => ['type' => TabularForm::INPUT_TEXT],
        'promo_tickets' => ['type' => TabularForm::INPUT_TEXT],
        'promo_value' => ['type' => TabularForm::INPUT_TEXT],
        'paid_run_from' => ['type' => TabularForm::INPUT_WIDGET,
            'widgetClass' => \kartik\datecontrol\DateControl::classname(),
            'options' => [
                'type' => \kartik\datecontrol\DateControl::FORMAT_DATE,
                'saveFormat' => 'php:Y-m-d',
                'ajaxConversion' => true,
                'options' => [
                    'pluginOptions' => [
                        'placeholder' => 'Choose Paid Run From',
                        'autoclose' => true
                    ]
                ],
            ]
        ],
        'paid_run_to' => ['type' => TabularForm::INPUT_WIDGET,
            'widgetClass' => \kartik\datecontrol\DateControl::classname(),
            'options' => [
                'type' => \kartik\datecontrol\DateControl::FORMAT_DATE,
                'saveFormat' => 'php:Y-m-d',
                'ajaxConversion' => true,
                'options' => [
                    'pluginOptions' => [
                        'placeholder' => 'Choose Paid Run To',
                        'autoclose' => true
                    ]
                ],
            ]
        ],
        'promo_run_from' => ['type' => TabularForm::INPUT_WIDGET,
            'widgetClass' => \kartik\datecontrol\DateControl::classname(),
            'options' => [
                'type' => \kartik\datecontrol\DateControl::FORMAT_DATE,
                'saveFormat' => 'php:Y-m-d',
                'ajaxConversion' => true,
                'options' => [
                    'pluginOptions' => [
                        'placeholder' => 'Choose Promo Run From',
                        'autoclose' => true
                    ]
                ],
            ]
        ],
        'promo_run_to' => ['type' => TabularForm::INPUT_WIDGET,
            'widgetClass' => \kartik\datecontrol\DateControl::classname(),
            'options' => [
                'type' => \kartik\datecontrol\DateControl::FORMAT_DATE,
                'saveFormat' => 'php:Y-m-d',
                'ajaxConversion' => true,
                'options' => [
                    'pluginOptions' => [
                        'placeholder' => 'Choose Promo Run To',
                        'autoclose' => true
                    ]
                ],
            ]
        ],
        'qty' => ['type' => TabularForm::INPUT_TEXT],
        'monday' => ['type' => TabularForm::INPUT_TEXT],
        'tuesday' => ['type' => TabularForm::INPUT_TEXT],
        'wednesday' => ['type' => TabularForm::INPUT_TEXT],
        'thursday' => ['type' => TabularForm::INPUT_TEXT],
        'friday' => ['type' => TabularForm::INPUT_TEXT],
        'saturday' => ['type' => TabularForm::INPUT_TEXT],
        'sunday' => ['type' => TabularForm::INPUT_TEXT],
        'gross' => ['type' => TabularForm::INPUT_TEXT],
        'net' => ['type' => TabularForm::INPUT_TEXT],
        'del' => [
            'type' => 'raw',
            'label' => '',
            'value' => function($model, $key) {
                return
                    Html::hiddenInput('Children[' . $key . '][id]', (!empty($model['id'])) ? $model['id'] : "") .
                    Html::a('<i class="glyphicon glyphicon-trash"></i>', '#', ['title' =>  'Delete', 'onClick' => 'delRowMkPrint(' . $key . '); return false;', 'id' => 'mk-print-del-btn']);
            },
        ],
    ],
    'gridSettings' => [
        'panel' => [
            'heading' => false,
            'type' => GridView::TYPE_DEFAULT,
            'before' => false,
            'footer' => false,
            'after' => Html::button('<i class="glyphicon glyphicon-plus"></i>' . 'Add Mk Print', ['type' => 'button', 'class' => 'btn btn-success kv-batch-create', 'onClick' => 'addRowMkPrint()']),
        ]
    ]
]);
echo  "    </div>\n\n";
?>

