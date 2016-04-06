<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use kartik\grid\GridView;

/* @var $this yii\web\View */
/* @var $model app\models\Inventory */

?>
<div class="inventory-view">

    <div class="row">
        <div class="col-sm-9">
            <h2><?= Html::encode($model->sku) ?></h2>
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
</div>