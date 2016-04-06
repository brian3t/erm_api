<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use kartik\grid\GridView;

/* @var $this yii\web\View */
/* @var $model app\models\Inventory */

$this->title = $model->sku;
$this->params['breadcrumbs'][] = ['label' => 'Inventory', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="inventory-view">

    <div class="row">
        <div class="col-sm-9">
            <h2><?= 'Inventory'.' '. Html::encode($this->title) ?></h2>
        </div>
    </div>

    <div class="row">
<?php 
    $gridColumn = [
        'sku',
        'quantity',
        'updatetime',
    ];
    echo DetailView::widget([
        'model' => $model,
        'attributes' => $gridColumn
    ]); 
?>
    </div>
    
    <div class="row">
<?php
    $gridColumnInventoryMp = [
        ['class' => 'yii\grid\SerialColumn'],
        [
                'attribute' => 'mp.name',
                'label' => 'Mp'
        ],
        [
                'attribute' => 'inventory.sku',
                'label' => 'Sku'
        ],
    ];
    echo Gridview::widget([
        'dataProvider' => $providerInventoryMp,
        'pjax' => true,
        'pjaxSettings' => ['options' => ['id' => 'kv-pjax-container-inventory-mp']],
        'panel' => [
            'type' => GridView::TYPE_PRIMARY,
            'heading' => Html::encode('Inventory Mp'.' '. $this->title),
        ],
        'columns' => $gridColumnInventoryMp
    ]);
?>
    </div>
</div>
