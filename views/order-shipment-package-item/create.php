<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\OrderShipmentPackageItem */

$this->title = 'Create Order Shipment Package Item';
$this->params['breadcrumbs'][] = ['label' => 'Order Shipment Package Item', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="order-shipment-package-item-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
