<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\MkProduction */

$this->title = 'Create Mk Production';
$this->params['breadcrumbs'][] = ['label' => 'Mk Production', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="mk-production-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
