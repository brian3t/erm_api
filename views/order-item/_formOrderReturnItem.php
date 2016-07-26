<div class="form-group" id="add-order-return-item">
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
    'formName' => 'OrderReturnItem',
    'checkboxColumn' => false,
    'actionColumn' => false,
    'attributeDefaults' => [
        'type' => TabularForm::INPUT_TEXT,
    ],
    'attributes' => [
        "id" => ['type' => TabularForm::INPUT_HIDDEN, 'columnOptions'=>['hidden'=>true]],
        'order_return_id' => [
            'label' => 'Order return',
            'type' => TabularForm::INPUT_WIDGET,
            'widgetClass' => \kartik\widgets\Select2::className(),
            'options' => [
                'data' => \yii\helpers\ArrayHelper::map(\app\models\OrderReturn::find()->orderBy('id')->asArray()->all(), 'id', 'id'),
                'options' => ['placeholder' => 'Choose Order return'],
            ],
            'columnOptions' => ['width' => '200px']
        ],
        'retailops_item_id' => ['type' => TabularForm::INPUT_TEXT],
        'channel_item_refnum' => ['type' => TabularForm::INPUT_TEXT],
        'quantity' => ['type' => TabularForm::INPUT_TEXT],
        'reason' => ['type' => TabularForm::INPUT_TEXT],
        'item_shipping_tax_amt' => ['type' => TabularForm::INPUT_TEXT],
        'tax_amt' => ['type' => TabularForm::INPUT_TEXT],
        'shipping_amt' => ['type' => TabularForm::INPUT_TEXT],
        'restock_fee_amt' => ['type' => TabularForm::INPUT_TEXT],
        'giftwrap_amt' => ['type' => TabularForm::INPUT_TEXT],
        'giftwrap_tax_amt' => ['type' => TabularForm::INPUT_TEXT],
        'product_amt' => ['type' => TabularForm::INPUT_TEXT],
        'recycling_amt' => ['type' => TabularForm::INPUT_TEXT],
        'subtotal_amt' => ['type' => TabularForm::INPUT_TEXT],
        'credit_amt' => ['type' => TabularForm::INPUT_TEXT],
        'del' => [
            'type' => 'raw',
            'label' => '',
            'value' => function($model, $key) {
                return Html::a('<i class="glyphicon glyphicon-trash"></i>', '#', ['title' =>  'Delete', 'onClick' => 'delRowOrderReturnItem(' . $key . '); return false;', 'id' => 'order-return-item-del-btn']);
            },
        ],
    ],
    'gridSettings' => [
        'panel' => [
            'heading' => false,
            'type' => GridView::TYPE_DEFAULT,
            'before' => false,
            'footer' => false,
            'after' => Html::button('<i class="glyphicon glyphicon-plus"></i>' . 'Add Order Return Item', ['type' => 'button', 'class' => 'btn btn-success kv-batch-create', 'onClick' => 'addRowOrderReturnItem()']),
        ]
    ]
]);
echo  "    </div>\n\n";
?>

