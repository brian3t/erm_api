<div class="form-group" id="add-order-shipment-package-item">
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
    'formName' => 'OrderShipmentPackageItem',
    'checkboxColumn' => false,
    'actionColumn' => false,
    'attributeDefaults' => [
        'type' => TabularForm::INPUT_TEXT,
    ],
    'attributes' => [
        "id" => ['type' => TabularForm::INPUT_HIDDEN, 'columnOptions'=>['hidden'=>true]],
        'retailops_order_item_id' => ['type' => TabularForm::INPUT_TEXT],
        'retailops_shipment_item_id' => ['type' => TabularForm::INPUT_TEXT],
        'quantity' => ['type' => TabularForm::INPUT_TEXT],
        'created_at' => ['type' => TabularForm::INPUT_WIDGET,
            'widgetClass' => \kartik\datecontrol\DateControl::classname(),
            'options' => [
                'type' => \kartik\datecontrol\DateControl::FORMAT_DATETIME,
                'saveFormat' => 'php:Y-m-d H:i:s',
                'ajaxConversion' => true,
                'options' => [
                    'pluginOptions' => [
                        'placeholder' => 'Choose Created At',
                        'autoclose' => true,
                    ]
                ],
            ]
        ],
        'updated_at' => ['type' => TabularForm::INPUT_WIDGET,
            'widgetClass' => \kartik\datecontrol\DateControl::classname(),
            'options' => [
                'type' => \kartik\datecontrol\DateControl::FORMAT_DATETIME,
                'saveFormat' => 'php:Y-m-d H:i:s',
                'ajaxConversion' => true,
                'options' => [
                    'pluginOptions' => [
                        'placeholder' => 'Choose Updated At',
                        'autoclose' => true,
                    ]
                ],
            ]
        ],
        'sku' => [
            'label' => 'Order item',
            'type' => TabularForm::INPUT_WIDGET,
            'widgetClass' => \kartik\widgets\Select2::className(),
            'options' => [
                'data' => \yii\helpers\ArrayHelper::map(\app\models\OrderItem::find()->orderBy('id')->asArray()->all(), 'sku', 'id'),
                'options' => ['placeholder' => 'Choose Order item'],
            ],
            'columnOptions' => ['width' => '200px']
        ],
        'rop_channel_item_refnum' => ['type' => TabularForm::INPUT_TEXT],
        'del' => [
            'type' => 'raw',
            'label' => '',
            'value' => function($model, $key) {
                return Html::a('<i class="glyphicon glyphicon-trash"></i>', '#', ['title' =>  'Delete', 'onClick' => 'delRowOrderShipmentPackageItem(' . $key . '); return false;', 'id' => 'order-shipment-package-item-del-btn']);
            },
        ],
    ],
    'gridSettings' => [
        'panel' => [
            'heading' => false,
            'type' => GridView::TYPE_DEFAULT,
            'before' => false,
            'footer' => false,
            'after' => Html::button('<i class="glyphicon glyphicon-plus"></i>' . 'Add Order Shipment Package Item', ['type' => 'button', 'class' => 'btn btn-success kv-batch-create', 'onClick' => 'addRowOrderShipmentPackageItem()']),
        ]
    ]
]);
echo  "    </div>\n\n";
?>

