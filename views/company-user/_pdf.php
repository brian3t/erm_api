<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use kartik\grid\GridView;

/* @var $this yii\web\View */
/* @var $model app\models\CompanyUser */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Company User', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="company-user-view">

    <div class="row">
        <div class="col-sm-9">
            <h2><?= 'Company User'.' '. Html::encode($this->title) ?></h2>
        </div>
    </div>

    <div class="row">
<?php 
    $gridColumn = [
                [
                'attribute' => 'company.name',
                'label' => 'Company'
            ],
        [
                'attribute' => 'user.username',
                'label' => 'User'
            ],
        'role',
    ];
    echo DetailView::widget([
        'model' => $model,
        'attributes' => $gridColumn
    ]); 
?>
    </div>
</div>
