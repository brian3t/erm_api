<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use kartik\grid\GridView;

/* @var $this yii\web\View */
/* @var $model app\models\InventoryDetail */

?>
<div class="inventory-detail-view">

    <div class="row">
        <div class="col-sm-9">
            <h2><?= Html::encode($model->id) ?></h2>
        </div>
    </div>

    <div class="row">
<?php 
    $gridColumn = [
        ['attribute' => 'id', 'hidden' => true],
        'quantity_type',
        [
            'attribute' => 'inventory.id',
            'label' => 'Inventory',
        ],
        'estimated_availability_date',
        'available_quantity',
        'total_quantity',
        'vendor_name',
        'po',
        'po_destination',
        'facility_name',
    ];
    echo DetailView::widget([
        'model' => $model,
        'attributes' => $gridColumn
    ]); 
?>
    </div>
</div>