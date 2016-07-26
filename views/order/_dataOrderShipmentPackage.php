<?php
use kartik\grid\GridView;
use yii\data\ArrayDataProvider;

$dataProvider = new ArrayDataProvider([
    'allModels' => $model->orderShipmentPackages,
    'key' => 'id',
]);
$gridColumns = [
    ['class' => 'yii\grid\SerialColumn'],
    'id',
    // ['class' => 'kartik\grid\ExpandRowColumn',
    //     'width' => '50px',
    //     'value' => function ($model, $key, $index, $column) {
    //         return GridView::ROW_COLLAPSED;
    //     },
    //     'detail' => function ($model, $key, $index, $column) {
    //         return Yii::$app->controller->renderPartial('_expand_shipment_package', ['model' => $model]);
    //     },
    //     'headerOptions' => ['class' => 'kartik-sheet-style'],
    //     'expandOneOnly' => true,
    // ],
    'carrier_name',
    'carrier_class_name',
    'channel_ship_code',
    'tracking_number',
    'weight_kg',
    'date_shipped',
    'retailops_package_id',
    [
        'label' => 'Items',
        'format' => 'html',
        'value' => function ($model, $key, $i, $c) {
            $items = [];
            foreach ($model->orderShipmentPackageItems as $item) {
                $items[] = $item->getName() . "<br/>";
            };
            return implode('<br/>', $items);
        },
    ],
    // 'created_at',
    // 'updated_at',
    ['class' => 'yii\grid\ActionColumn',
        'controller' => 'order-shipment-package',
    ],
];

echo GridView::widget([
    'dataProvider' => $dataProvider,
    'columns' => $gridColumns,
    'containerOptions' => ['style' => 'overflow: auto'],
    'pjax' => true,
    'beforeHeader' => [
        [
            'options' => ['class' => 'skip-export'],
        ],
    ],
    'export' => [
        'fontAwesome' => true,
    ],
    'bordered' => true,
    'striped' => true,
    'condensed' => true,
    'responsive' => true,
    'hover' => true,
    'showPageSummary' => false,
    'persistResize' => false,
]);
