<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\OrderShipmentPackageItem */

$this->title = 'Save As New Order Shipment Package Item: '. ' ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Order Shipment Package Item', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Save As New';
?>
<div class="order-shipment-package-item-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
    'model' => $model,
    ]) ?>

</div>
