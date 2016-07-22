<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use kartik\grid\GridView;

/* @var $this yii\web\View */
/* @var $model app\models\InventoryDetail */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Inventory Detail', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="inventory-detail-view">

    <div class="row">
        <div class="col-sm-9">
            <h2><?= 'Inventory Detail'.' '. Html::encode($this->title) ?></h2>
        </div>
    </div>

    <div class="row">
<?php 
    $gridColumn = [
                'quantity_type',
        [
                'attribute' => 'inventory.id',
                'label' => 'Inventory'
            ],
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
    echo DetailView::widget([
        'model' => $model,
        'attributes' => $gridColumn
    ]); 
?>
    </div>
</div>
