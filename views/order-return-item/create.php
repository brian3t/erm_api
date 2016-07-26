<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\OrderReturnItem */

$this->title = 'Create Order Return Item';
$this->params['breadcrumbs'][] = ['label' => 'Order Return Item', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="order-return-item-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
