<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use kartik\grid\GridView;

/* @var $this yii\web\View */
/* @var $model app\models\Mp */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Mp', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="mp-view">

    <div class="row">
        <div class="col-sm-9">
            <h2><?= 'Mp'.' '. Html::encode($this->title) ?></h2>
        </div>
    </div>

    <div class="row">
<?php 
    $gridColumn = [
        ['attribute' => 'id', 'hidden' => true],
        'name',
    ];
    echo DetailView::widget([
        'model' => $model,
        'attributes' => $gridColumn
    ]); 
?>
    </div>
</div>
