<div class="form-group" id="add-order-item">
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
    'formName' => 'OrderItem',
    'checkboxColumn' => false,
    'actionColumn' => false,
    'attributeDefaults' => [
        'type' => TabularForm::INPUT_TEXT,
    ],
    'attributes' => [
        "id" => ['type' => TabularForm::INPUT_HIDDEN, 'columnOptions'=>['hidden'=>true]],
        'sku' => ['type' => TabularForm::INPUT_TEXT],
        'sku_description' => ['type' => TabularForm::INPUT_TEXT],
        'options' => ['type' => TabularForm::INPUT_TEXT],
        'unit_price' => ['type' => TabularForm::INPUT_TEXT],
        'discount_amt' => ['type' => TabularForm::INPUT_TEXT],
        'discount_pct' => ['type' => TabularForm::INPUT_TEXT],
        'recycling_amt' => ['type' => TabularForm::INPUT_TEXT],
        'ship_amt' => ['type' => TabularForm::INPUT_TEXT],
        'shiptax_amt' => ['type' => TabularForm::INPUT_TEXT],
        'unit_tax' => ['type' => TabularForm::INPUT_TEXT],
        'unit_tax_pct' => ['type' => TabularForm::INPUT_TEXT],
        'vat_pct' => ['type' => TabularForm::INPUT_TEXT],
        'quantity' => ['type' => TabularForm::INPUT_TEXT],
        'item_type' => ['type' => TabularForm::INPUT_DROPDOWN_LIST,
                    'items' => [ 'ship' => 'Ship', 'advisory' => 'Advisory', 'instore' => 'Instore', ],
                    'options' => [
                        'columnOptions' => ['width' => '185px'],
                        'options' => ['placeholder' => 'Choose Item Type'],
                    ]
        ],
        'status' => ['type' => TabularForm::INPUT_TEXT],
        'last_mp_updated' => ['type' => TabularForm::INPUT_TEXT],
        'mp_item_id' => ['type' => TabularForm::INPUT_TEXT],
        'extra_info' => ['type' => TabularForm::INPUT_TEXT],
        'del' => [
            'type' => 'raw',
            'label' => '',
            'value' => function($model, $key) {
                return Html::a('<i class="glyphicon glyphicon-trash"></i>', '#', ['title' =>  'Delete', 'onClick' => 'delRowOrderItem(' . $key . '); return false;', 'id' => 'order-item-del-btn']);
            },
        ],
    ],
    'gridSettings' => [
        'panel' => [
            'heading' => false,
            'type' => GridView::TYPE_DEFAULT,
            'before' => false,
            'footer' => false,
            'after' => Html::button('<i class="glyphicon glyphicon-plus"></i>' . 'Add Order Item', ['type' => 'button', 'class' => 'btn btn-success kv-batch-create', 'onClick' => 'addRowOrderItem()']),
        ]
    ]
]);
echo  "    </div>\n\n";
?>

