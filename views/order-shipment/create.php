<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\OrderShipment */

$this->title = 'Create Order Shipment';
$this->params['breadcrumbs'][] = ['label' => 'Order Shipment', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="order-shipment-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
