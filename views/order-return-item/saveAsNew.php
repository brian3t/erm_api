<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\OrderReturnItem */

$this->title = 'Save As New Order Return Item: '. ' ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Order Return Item', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Save As New';
?>
<div class="order-return-item-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
    'model' => $model,
    ]) ?>

</div>
