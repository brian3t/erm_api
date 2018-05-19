<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\MkMisc */

$this->title = 'Update Mk Misc: ' . ' ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Mk Misc', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="mk-misc-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
