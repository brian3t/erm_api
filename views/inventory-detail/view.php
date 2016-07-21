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
        <div class="col-sm-3" style="margin-top: 15px">
                        
            <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
            <?= Html::a('Delete', ['delete', 'id' => $model->id], [
                'class' => 'btn btn-danger',
                'data' => [
                    'confirm' => 'Are you sure you want to delete this item?',
                    'method' => 'post',
                ],
            ])
            ?>
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