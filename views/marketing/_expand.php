<?php
use yii\helpers\Html;
use kartik\tabs\TabsX;
use yii\helpers\Url;
$items = [
    [
        'label' => '<i class="glyphicon glyphicon-book"></i> '. Html::encode('Marketing'),
        'content' => $this->render('_detail', [
            'model' => $model,
        ]),
    ],
    [
        'label' => '<i class="glyphicon glyphicon-book"></i> '. Html::encode('Radio'),
        'content' => $this->render('_dataMkRadio', [
            'model' => $model,
            'row' => $model->mkRadios,
        ]),
    ],
	[
        'label' => '<i class="glyphicon glyphicon-book"></i> '. Html::encode('Television'),
        'content' => $this->render('_dataMkTelevision', [
            'model' => $model,
            'row' => $model->mkTelevisions,
        ]),
    ],
	[
        'label' => '<i class="glyphicon glyphicon-book"></i> '. Html::encode('Internet'),
        'content' => $this->render('_dataMkInternet', [
            'model' => $model,
            'row' => $model->mkInternets,
        ]),
    ],
	[
        'label' => '<i class="glyphicon glyphicon-book"></i> '. Html::encode('Print'),
        'content' => $this->render('_dataMkPrint', [
            'model' => $model,
            'row' => $model->mkPrints,
        ]),
    ],
            [
        'label' => '<i class="glyphicon glyphicon-book"></i> '. Html::encode('Production'),
        'content' => $this->render('_dataMkProduction', [
            'model' => $model,
            'row' => $model->mkProductions,
        ]),
    ],
	[
        'label' => '<i class="glyphicon glyphicon-book"></i> '. Html::encode('Misc'),
        'content' => $this->render('_dataMkMisc', [
            'model' => $model,
            'row' => $model->mkMiscs,
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
