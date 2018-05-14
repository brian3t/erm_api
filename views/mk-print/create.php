<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\MkPrint */

$this->title = 'Create Mk Print';
$this->params['breadcrumbs'][] = ['label' => 'Mk Print', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="mk-print-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
