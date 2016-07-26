<?php
use kartik\grid\GridView;
use yii\data\ArrayDataProvider;

    $dataProvider = new ArrayDataProvider([
        'allModels' => $model->orderShipmentPackageItems,
        'key' => 'id'
    ]);
    $gridColumns = [
        ['class' => 'yii\grid\SerialColumn'],
                [
                'attribute' => 'orderItem.id',
                'label' => 'Order Item'
            ],
        'retailops_order_item_id',
        'retailops_shipment_item_id',
        'quantity',
        'created_at',
        'updated_at',
        'sku',
        'rop_channel_item_refnum',
        [
            'class' => 'yii\grid\ActionColumn',
            'controller' => 'order-shipment-package-item'
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
