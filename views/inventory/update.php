<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Inventory */

$this->title = 'Update Inventory: ' . ' ' . $model->sku;
$this->params['breadcrumbs'][] = ['label' => 'Inventory', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->sku, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="inventory-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
