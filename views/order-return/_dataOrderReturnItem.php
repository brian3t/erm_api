<?php
use kartik\grid\GridView;
use yii\data\ArrayDataProvider;

    $dataProvider = new ArrayDataProvider([
        'allModels' => $model->orderReturnItems,
        'key' => 'id'
    ]);
    $gridColumns = [
        ['class' => 'yii\grid\SerialColumn'],
                'retailops_item_id',
        'channel_item_refnum',
        [
                'attribute' => 'orderItem.id',
                'label' => 'Order Item ID'
            ],
        'quantity',
        'reason',
        'item_shipping_tax_amt',
        'tax_amt',
        'shipping_amt',
        'restock_fee_amt',
        'giftwrap_amt',
        'giftwrap_tax_amt',
        'product_amt',
        'recycling_amt',
        'subtotal_amt',
        'credit_amt',
        [
            'class' => 'yii\grid\ActionColumn',
            'controller' => 'order-return-item'
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
