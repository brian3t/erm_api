<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\CompanyUser */

$this->title = 'Create Company User';
$this->params['breadcrumbs'][] = ['label' => 'Company User', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="company-user-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
