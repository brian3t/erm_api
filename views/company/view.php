<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use kartik\grid\GridView;

/* @var $this yii\web\View */
/* @var $model app\models\Company */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Company', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="company-view">

    <div class="row">
        <div class="col-sm-9">
            <h2><?= 'Company'.' '. Html::encode($this->title) ?></h2>
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
        ['attribute' => 'id', 'visible' => false],
        'name',
        'website',
        'headline',
        'industry',
        'phone_number',
        'address1',
        'address2',
        'city',
        'state',
        'postal_code',
        'num_of_employee',
        'annual_revenue',
        'facebook_fans',
        'twitter_handle',
        'twitter_followers',
        'linkedin_company_page',
        'timezone',
        'description',
        'line_of_business',
    ];
    echo DetailView::widget([
        'model' => $model,
        'attributes' => $gridColumn
    ]); 
?>
    </div>
    
    <div class="row">
<?php
if($providerUser->totalCount){
    $gridColumnUser = [
        ['class' => 'yii\grid\SerialColumn'],
            ['attribute' => 'id', 'visible' => false],
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
            'first_name',
            'last_name',
            'job_title',
            'line_of_business',
            'union_memberships',
            'phone_number_type',
            'phone_number',
            'birthdate',
            'website_url:url',
            'twitter_id',
            'facebook_id',
            'instagram_id',
            'google_id',
            'yahoo_id',
            'linkedin_id',
    ];
    echo Gridview::widget([
        'dataProvider' => $providerUser,
        'pjax' => true,
        'pjaxSettings' => ['options' => ['id' => 'kv-pjax-container-user']],
        'panel' => [
        'type' => GridView::TYPE_PRIMARY,
        'heading' => '<span class="glyphicon glyphicon-book"></span> ' . Html::encode('User'),
        ],
        'columns' => $gridColumnUser
    ]);
}
?>
    </div>
</div>