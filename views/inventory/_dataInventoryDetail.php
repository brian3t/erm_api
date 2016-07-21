<?php
/**
 * @var \app\models\base\Inventory $model
 */
use kartik\grid\GridView;
use yii\data\ArrayDataProvider;

$dataProvider = new ArrayDataProvider([
    'allModels' => $model->inventoryDetails,
    'key' => 'id'
]);
$gridColumns = [
    ['class' => 'yii\grid\SerialColumn'],
    ['attribute' => 'id', 'hidden' => true],
    'quantity_type',
    'estimated_availability_date',
    'available_quantity',
    'total_quantity',
    'vendor_name',
    'po',
    'po_destination',
    'facility_name',
    [
        'class' => 'yii\grid\ActionColumn',
        'controller' => 'inventory-detail'
    ],
];

echo GridView::widget([
    'dataProvider' => $dataProvider,
    'columns' => $gridColumns,
    'containerOptions' => ['style' => 'overflow: auto'],
    'pjax' => true,
    'beforeHeader' => [
        [
            'options' => ['class' => 'skip-export']
        ]
    ],
    'export' => [
        'fontAwesome' => true
    ],
    'bordered' => true,
    'striped' => true,
    'condensed' => true,
    'responsive' => true,
    'hover' => true,
    'showPageSummary' => false,
    'persistResize' => false,
]);
