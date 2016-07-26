<?php
use yii\helpers\Html;
use kartik\tabs\TabsX;
use yii\helpers\Url;
$items = [
    [
        'label' => '<i class="glyphicon glyphicon-book"></i> '. Html::encode('Order'),
        'content' => $this->render('_detail', [
            'model' => $model,
        ]),
    ],
                [
        'label' => '<i class="glyphicon glyphicon-book"></i> '. Html::encode('Order Item'),
        'content' => $this->render('_dataOrderItem', [
            'model' => $model,
            'row' => $model->orderItems,
        ]),
    ],
            [
        'label' => '<i class="glyphicon glyphicon-book"></i> '. Html::encode('Order Payment'),
        'content' => $this->render('_dataOrderPayment', [
            'model' => $model,
            'row' => $model->orderPayments,
        ]),
    ],
            [
        'label' => '<i class="glyphicon glyphicon-book"></i> '. Html::encode('Order Return'),
        'content' => $this->render('_dataOrderReturn', [
            'model' => $model,
            'row' => $model->orderReturns,
        ]),
    ],
            [
        'label' => '<i class="glyphicon glyphicon-book"></i> '. Html::encode('Order Shipment'),
        'content' => $this->render('_dataOrderShipment', [
            'model' => $model,
            'row' => $model->orderShipments,
        ]),
    ],
    ];
echo TabsX::widget([
    'items' => $items,
    'position' => TabsX::POS_ABOVE,
    'encodeLabels' => false,
    'class' => 'tes',
    'pluginOptions' => [
        'bordered' => true,
        'sideways' => true,
        'enableCache' => false
    ],
]);
?>
