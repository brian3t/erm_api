<?php
use kartik\grid\GridView;
use yii\data\ArrayDataProvider;

    $dataProvider = new ArrayDataProvider([
        'allModels' => $model->orderItems,
        'key' => 'id'
    ]);
    $gridColumns = [
        ['class' => 'yii\grid\SerialColumn'],
        'id',
                'sku',
        'sku_description',
        'options',
        'unit_price',
        'discount_amt',
        'discount_pct',
        'recycling_amt',
        'ship_amt',
        'shiptax_amt',
        'unit_tax',
        'unit_tax_pct',
        'vat_pct',
        'quantity',
        'item_type',
        'status',
        'last_mp_updated',
        'mp_item_id',
        'extra_info',
        'created_at',
        'updated_at',
        [
            'class' => 'yii\grid\ActionColumn',
            'controller' => 'order-item'
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
