<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use kartik\grid\GridView;

/* @var $this yii\web\View */
/* @var $model app\models\base\User */

$this->title = $model->username;
$this->params['breadcrumbs'][] = ['label' => 'User', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-view">
    
    <div class="row">
        <div class="col-sm-9">
            <h2><?= 'User' . ' ' . Html::encode($this->title) ?></h2>
        </div>
        <div class="col-sm-3" style="margin-top: 15px">
            
            <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
            <?= Html::a('Delete', ['delete', 'id' => $model->id], [
                'class' => 'btn btn-danger',
                'data' => [
                    'confirm' => 'Are you sure you want to delete this item?',
                    'method' => 'post',
                ],
            ])
            ?>
        </div>
    </div>
    
    <div class="row">
        <?php
        $gridColumn = [
            ['attribute' => 'id', 'hidden' => true],
            'username',
            'email:email',
            'password_hash',
            'auth_key',
            'confirmed_at',
            'unconfirmed_email:email',
            'blocked_at',
            'registration_ip',
            'created_at',
            'updated_at',
            'flags',
        ];
        echo DetailView::widget([
            'model' => $model,
            'attributes' => $gridColumn,
        ]);
        ?>
    </div>
    
    <div class="row">
        <?php
        if ($providerCompanyUser->totalCount) {
            $gridColumnCompanyUser = [
                ['class' => 'yii\grid\SerialColumn'],
                [
                    'attribute' => 'company.name',
                    'label' => 'Company',
                ],
                [
                    'attribute' => 'user.username',
                    'label' => 'User',
                ],
                'role',
            ];
            echo Gridview::widget([
                'dataProvider' => $providerCompanyUser,
                'pjax' => true,
                'pjaxSettings' => ['options' => ['id' => 'kv-pjax-container-company-user']],
                'panel' => [
                    'type' => GridView::TYPE_PRIMARY,
                    'heading' => '<span class="glyphicon glyphicon-book"></span> ' . Html::encode('Company'),
                ],
                'columns' => $gridColumnCompanyUser,
            ]);
        }
        ?>
    </div>


</div>