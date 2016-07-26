<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\OrderShipmentPackage */

$this->title = 'Create Order Shipment Package';
$this->params['breadcrumbs'][] = ['label' => 'Order Shipment Package', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="order-shipment-package-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
