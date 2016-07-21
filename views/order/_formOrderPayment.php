<?php
use kartik\grid\GridView;
use kartik\builder\TabularForm;
use yii\data\ArrayDataProvider;
use yii\helpers\Html;
use yii\widgets\Pjax;

Pjax::begin();
$dataProvider = new ArrayDataProvider([
    'allModels' => $row,
    'pagination' => [
        'pageSize' => -1
    ]
]);
echo TabularForm::widget([
    'dataProvider' => $dataProvider,
    'formName' => 'OrderPayment',
    'checkboxColumn' => false,
    'actionColumn' => false,
    'attributeDefaults' => [
        'type' => TabularForm::INPUT_TEXT,
    ],
    'attributes' => [
        "id" => ['type' => TabularForm::INPUT_HIDDEN, 'columnOptions'=>['hidden'=>true]],
        'amount' => ['type' => TabularForm::INPUT_TEXT],
        'payment_processing_type' => ['type' => TabularForm::INPUT_DROPDOWN_LIST,
                    'options' => [
                        'items' => [ 'channel_payment' => 'Channel payment', 'channel_storecredit' => 'Channel storecredit', 'channel_giftcert' => 'Channel giftcert', 'authorize.net' => 'Authorize.net', ],
                        'columnOptions => ['width' => '185px'],
                        'options' => ['placeholder' => 'Choose Payment Processing Type'],
                    ]
        ],
        'transaction_type' => ['type' => TabularForm::INPUT_DROPDOWN_LIST,
                    'options' => [
                        'items' => [ 'auth' => 'Auth', 'charge' => 'Charge', ],
                        'columnOptions => ['width' => '185px'],
                        'options' => ['placeholder' => 'Choose Transaction Type'],
                    ]
        ],
        'payment_type' => ['type' => TabularForm::INPUT_TEXT],
        'created_at' => ['type' => TabularForm::INPUT_WIDGET,
        'widgetClass' => \kartik\widgets\DateTimePicker::classname(),
            'options' => [
                'options' => ['placeholder' => 'Choose Created At'],
                'pluginOptions' => [
                    'autoclose' => true,
                    'format' => 'hh:ii:ss dd-M-yyyy'
                ]
            ]
        ],
        'updated_at' => ['type' => TabularForm::INPUT_WIDGET,
        'widgetClass' => \kartik\widgets\DateTimePicker::classname(),
            'options' => [
                'options' => ['placeholder' => 'Choose Updated At'],
                'pluginOptions' => [
                    'autoclose' => true,
                    'format' => 'hh:ii:ss dd-M-yyyy'
                ]
            ]
        ],
        'del' => [
            'type' => 'raw',
            'label' => '',
            'value' => function($model, $key) {
                return Html::a('<i class="glyphicon glyphicon-trash"></i>', '#', ['title' =>  'Delete', 'onClick' => 'delRowOrderPayment(' . $key . '); return false;', 'id' => 'order-payment-del-btn']);
            },
        ],
    ],
    'gridSettings' => [
        'panel' => [
            'heading' => '<span class="glyphicon glyphicon-book"></span> ' . 'Order Payment',
            'type' => GridView::TYPE_INFO,
            'before' => false,
            'footer' => false,
            'after' => Html::button('<i class="glyphicon glyphicon-plus"></i>' . 'Add Row', ['type' => 'button', 'class' => 'btn btn-success kv-batch-create', 'onClick' => 'addRowOrderPayment()']),
        ]
    ]
]);
Pjax::end();
?>
