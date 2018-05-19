<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\MkProduction */

$this->title = 'Update Mk Production: ' . ' ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Mk Production', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="mk-production-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
