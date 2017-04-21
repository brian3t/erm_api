<div class="form-group" id="add-settlement">
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
    'formName' => 'Settlement',
    'checkboxColumn' => false,
    'actionColumn' => false,
    'attributeDefaults' => [
        'type' => TabularForm::INPUT_TEXT,
    ],
    'attributes' => [
        "id" => ['type' => TabularForm::INPUT_HIDDEN, 'visible' => false],
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
        'settlement_id' => ['type' => TabularForm::INPUT_TEXT],
        'first_party_id' => ['type' => TabularForm::INPUT_TEXT],
        'first_party_event_id' => ['type' => TabularForm::INPUT_TEXT],
        'first_party_capacity' => ['type' => TabularForm::INPUT_TEXT],
        'second_party_event_id' => ['type' => TabularForm::INPUT_TEXT],
        'second_party_capacity' => ['type' => TabularForm::INPUT_TEXT],
        'second_party_date' => ['type' => TabularForm::INPUT_WIDGET,
            'widgetClass' => \kartik\datecontrol\DateControl::classname(),
            'options' => [
                'type' => \kartik\datecontrol\DateControl::FORMAT_DATE,
                'saveFormat' => 'php:Y-m-d',
                'ajaxConversion' => true,
                'options' => [
                    'pluginOptions' => [
                        'placeholder' => 'Choose Second Party Date',
                        'autoclose' => true
                    ]
                ],
            ]
        ],
        'second_party_artist_id' => [
            'label' => 'User',
            'type' => TabularForm::INPUT_WIDGET,
            'widgetClass' => \kartik\widgets\Select2::className(),
            'options' => [
                'data' => \yii\helpers\ArrayHelper::map(\app\models\User::find()->orderBy('username')->asArray()->all(), 'id', 'username'),
                'options' => ['placeholder' => 'Choose User'],
            ],
            'columnOptions' => ['width' => '200px']
        ],
        'note' => ['type' => TabularForm::INPUT_TEXT],
        'artist_walkout_final' => ['type' => TabularForm::INPUT_TEXT],
        'ad_plan_final' => ['type' => TabularForm::INPUT_TEXT],
        'promoter_revenue_final' => ['type' => TabularForm::INPUT_TEXT],
        'ticket_sales_final' => ['type' => TabularForm::INPUT_TEXT],
        'belong_company_id' => [
            'label' => 'Company',
            'type' => TabularForm::INPUT_WIDGET,
            'widgetClass' => \kartik\widgets\Select2::className(),
            'options' => [
                'data' => \yii\helpers\ArrayHelper::map(\app\models\Company::find()->orderBy('name')->asArray()->all(), 'id', 'name'),
                'options' => ['placeholder' => 'Choose Company'],
            ],
            'columnOptions' => ['width' => '200px']
        ],
        'del' => [
            'type' => 'raw',
            'label' => '',
            'value' => function($model, $key) {
                return Html::a('<i class="glyphicon glyphicon-trash"></i>', '#', ['title' =>  'Delete', 'onClick' => 'delRowSettlement(' . $key . '); return false;', 'id' => 'settlement-del-btn']);
            },
        ],
    ],
    'gridSettings' => [
        'panel' => [
            'heading' => false,
            'type' => GridView::TYPE_DEFAULT,
            'before' => false,
            'footer' => false,
            'after' => Html::button('<i class="glyphicon glyphicon-plus"></i>' . 'Add Settlement', ['type' => 'button', 'class' => 'btn btn-success kv-batch-create', 'onClick' => 'addRowSettlement()']),
        ]
    ]
]);
echo  "    </div>\n\n";
?>

