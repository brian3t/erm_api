<div class="form-group" id="add-order-return">
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
    'formName' => 'OrderReturn',
    'checkboxColumn' => false,
    'actionColumn' => false,
    'attributeDefaults' => [
        'type' => TabularForm::INPUT_TEXT,
    ],
    'attributes' => [
        "id" => ['type' => TabularForm::INPUT_HIDDEN, 'columnOptions'=>['hidden'=>true]],
        'retailops_return_id' => ['type' => TabularForm::INPUT_TEXT],
        'retailops_rma_id' => ['type' => TabularForm::INPUT_TEXT],
        'product_amt' => ['type' => TabularForm::INPUT_TEXT],
        'subtotal_amt' => ['type' => TabularForm::INPUT_TEXT],
        'discount_amt' => ['type' => TabularForm::INPUT_TEXT],
        'shipping_amt' => ['type' => TabularForm::INPUT_TEXT],
        'tax_amt' => ['type' => TabularForm::INPUT_TEXT],
        'refund_amt' => ['type' => TabularForm::INPUT_TEXT],
        'del' => [
            'type' => 'raw',
            'label' => '',
            'value' => function($model, $key) {
                return Html::a('<i class="glyphicon glyphicon-trash"></i>', '#', ['title' =>  'Delete', 'onClick' => 'delRowOrderReturn(' . $key . '); return false;', 'id' => 'order-return-del-btn']);
            },
        ],
    ],
    'gridSettings' => [
        'panel' => [
            'heading' => false,
            'type' => GridView::TYPE_DEFAULT,
            'before' => false,
            'footer' => false,
            'after' => Html::button('<i class="glyphicon glyphicon-plus"></i>' . 'Add Order Return', ['type' => 'button', 'class' => 'btn btn-success kv-batch-create', 'onClick' => 'addRowOrderReturn()']),
        ]
    ]
]);
echo  "    </div>\n\n";
?>

