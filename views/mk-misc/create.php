<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\MkMisc */

$this->title = 'Create Mk Misc';
$this->params['breadcrumbs'][] = ['label' => 'Mk Misc', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="mk-misc-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
