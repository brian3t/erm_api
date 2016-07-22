<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use kartik\grid\GridView;

/* @var $this yii\web\View */
/* @var $model app\models\Inventory */

$this->title = $model->id;
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
        'quantity_available',
        'created_at',
        'updated_at',
    ];
    echo DetailView::widget([
        'model' => $model,
        'attributes' => $gridColumn
    ]); 
?>
    </div>
    
    <div class="row">
<?php
if($providerInventoryDetail->totalCount){
    $gridColumnInventoryDetail = [
        ['class' => 'yii\grid\SerialColumn'],
                'quantity_type',
                'estimated_availability_date',
        'available_quantity',
        'total_quantity',
        'vendor_name',
        'po',
        'po_destination',
        'facility_name',
        'created_at',
        'updated_at',
    ];
    echo Gridview::widget([
        'dataProvider' => $providerInventoryDetail,
        'panel' => [
            'type' => GridView::TYPE_PRIMARY,
            'heading' => Html::encode('Inventory Detail'),
        ],
        'panelHeadingTemplate' => '<h4>{heading}</h4>{summary}',
        'toggleData' => false,
        'columns' => $gridColumnInventoryDetail
    ]);
}
?>
    </div>
</div>
