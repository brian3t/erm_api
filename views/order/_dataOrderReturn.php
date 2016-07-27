<?php
use kartik\grid\GridView;
use yii\data\ArrayDataProvider;

    $dataProvider = new ArrayDataProvider([
        'allModels' => $model->orderReturns,
        'key' => 'id'
    ]);
    $gridColumns = [
        ['class' => 'yii\grid\SerialColumn'],
        'id',
                'retailops_return_id',
        'retailops_rma_id',
        'product_amt',
        'subtotal_amt',
        'discount_amt',
        'shipping_amt',
        'tax_amt',
        'refund_amt',
        'refund_action',
        'created_at',
        'updated_at',
        ['label'=>'Items',
        'format'=>'html',
        'value'=>function($model, $key, $index, $column){
            $result = [];
            foreach ($model->orderReturnItems as $orderReturnItem){
                $result[] = $orderReturnItem->getName();
            }
            return implode('<br/>', $result);
        }],
        [
            'class' => 'yii\grid\ActionColumn',
            'controller' => 'order-return'
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
