<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\MkPrint */

$this->title = 'Update Mk Print: ' . ' ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Mk Print', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="mk-print-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
