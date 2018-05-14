<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\MkInternet */

$this->title = 'Create Mk Internet';
$this->params['breadcrumbs'][] = ['label' => 'Mk Internet', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="mk-internet-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
