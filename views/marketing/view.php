<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use kartik\grid\GridView;

/* @var $this yii\web\View */
/* @var $model app\models\Marketing */

$this->title = $model->offer->event_id;
$this->params['breadcrumbs'][] = ['label' => 'Marketing for', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="marketing-view">

    <div class="row">
        <div class="col-sm-9">
            <h2><?= 'Marketing'.' '. Html::encode($this->title) ?></h2>
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
        [
            'attribute' => 'offer.id',
            'label' => 'Offer',
        ],
        [
            'attribute' => 'user.username',
            'label' => 'User',
        ],
        'budget',
        'note',
    ];
    echo DetailView::widget([
        'model' => $model,
        'attributes' => $gridColumn
    ]);
?>
    </div>
    <div class="row">
        <h4>User<?= ' '. Html::encode($this->title) ?></h4>
    </div>
    <?php 
    $gridColumnUser = [
        ['attribute' => 'id', 'visible' => false],
        'username',
        'company_id',
        'email',
        'first_name',
        'belong_company_id',
    ];
    echo DetailView::widget([
        'model' => $model->user,
        'attributes' => $gridColumnUser    ]);
    ?>
    <div class="row">
        <h4>Offer<?= ' '. Html::encode($this->title) ?></h4>
    </div>
    <?php 
    $gridColumnOffer = [
        ['attribute' => 'id', 'visible' => false],
        [
            'attribute' => 'user.username',
            'label' => 'User',
        ],
        'offer_type',
        'show_date',
        'on_sale_date',
        'belong_company_id',
    ];
    echo DetailView::widget([
        'model' => $model->offer,
        'attributes' => $gridColumnOffer    ]);
    ?>
 
    
    <div class="row">
<?php
if($providerMkRadio->totalCount){
    $gridColumnMkRadio = [
        ['class' => 'yii\grid\SerialColumn'],
            ['attribute' => 'id', 'visible' => false],
                        [
                'attribute' => 'company.name',
                'label' => 'Company'
            ],
            'station',
            'format',
            'contact',
            'contact_phone_email:email',
            'promo_mentions',
            'promo_tickets',
            'promo_value',
            'promo_run_from',
            'promo_run_to',
            'paid_run_from',
            'paid_run_to',
            'paid_spots',
            'thirty',
            'sixty',
            'gross',
            'net',
    ];
    echo Gridview::widget([
        'dataProvider' => $providerMkRadio,
        'pjax' => true,
        'pjaxSettings' => ['options' => ['id' => 'kv-pjax-container-mk-radio']],
        'panel' => [
            'type' => GridView::TYPE_PRIMARY,
            'heading' => '<span class="glyphicon glyphicon-book"></span> ' . Html::encode('Radio'),
        ],
        'export' => false,
        'columns' => $gridColumnMkRadio
    ]);
}
?>

    </div>
    
   <div class="row">
<?php
if($providerMkTelevision->totalCount){
    $gridColumnMkTelevision = [
        ['class' => 'yii\grid\SerialColumn'],
            ['attribute' => 'id', 'visible' => false],
                        [
                'attribute' => 'company.name',
                'label' => 'Company'
            ],
            'tv_company',
            'format',
            'contact',
            'phone_email:email',
            'impressions',
            'promo_tickets',
            'promo_value',
            'promo_run_from',
            'promo_run_to',
            'paid_run_from',
            'paid_run_to',
            'qty',
            'dg_code',
            'gross',
            'net',
    ];
    echo Gridview::widget([
        'dataProvider' => $providerMkTelevision,
        'pjax' => true,
        'pjaxSettings' => ['options' => ['id' => 'kv-pjax-container-mk-television']],
        'panel' => [
            'type' => GridView::TYPE_PRIMARY,
            'heading' => '<span class="glyphicon glyphicon-book"></span> ' . Html::encode('Television'),
        ],
        'export' => false,
        'columns' => $gridColumnMkTelevision
    ]);
}
?>

    </div>
	
    <div class="row">
<?php
if($providerMkInternet->totalCount){
    $gridColumnMkInternet = [
        ['class' => 'yii\grid\SerialColumn'],
            ['attribute' => 'id', 'visible' => false],
                        [
                'attribute' => 'company.name',
                'label' => 'Company'
            ],
            'provider_company',
            'format',
            'contact',
            'phone_email:email',
            'impressions',
            'promo_tickets',
            'promo_value',
            'promo_run_from',
            'promo_run_to',
            'paid_run_from',
            'paid_run_to',
            'qty',
            'comments',
            'gross',
            'net',
    ];
    echo Gridview::widget([
        'dataProvider' => $providerMkInternet,
        'pjax' => true,
        'pjaxSettings' => ['options' => ['id' => 'kv-pjax-container-mk-internet']],
        'panel' => [
            'type' => GridView::TYPE_PRIMARY,
            'heading' => '<span class="glyphicon glyphicon-book"></span> ' . Html::encode('Internet'),
        ],
        'export' => false,
        'columns' => $gridColumnMkInternet
    ]);
}
?>

    </div>
  
    <div class="row">
<?php
if($providerMkPrint->totalCount){
    $gridColumnMkPrint = [
        ['class' => 'yii\grid\SerialColumn'],
            ['attribute' => 'id', 'visible' => false],
                        [
                'attribute' => 'company.name',
                'label' => 'Company'
            ],
            'print_media',
            'type',
            'contact',
            'phone_email:email',
            'size',
            'promo_tickets',
            'promo_value',
            'paid_run_from',
            'paid_run_to',
            'promo_run_from',
            'promo_run_to',
            'qty',
            'monday',
            'tuesday',
            'wednesday',
            'thursday',
            'friday',
            'saturday',
            'sunday',
            'gross',
            'net',
    ];
    echo Gridview::widget([
        'dataProvider' => $providerMkPrint,
        'pjax' => true,
        'pjaxSettings' => ['options' => ['id' => 'kv-pjax-container-mk-print']],
        'panel' => [
            'type' => GridView::TYPE_PRIMARY,
            'heading' => '<span class="glyphicon glyphicon-book"></span> ' . Html::encode('Print'),
        ],
        'export' => false,
        'columns' => $gridColumnMkPrint
    ]);
}
?>

    </div>
    
    <div class="row">
<?php
if($providerMkProduction->totalCount){
    $gridColumnMkProduction = [
        ['class' => 'yii\grid\SerialColumn'],
            ['attribute' => 'id', 'visible' => false],
                        [
                'attribute' => 'company.name',
                'label' => 'Company'
            ],
            'provider_company',
            'type',
            'contact',
            'phone_email:email',
            'gross',
            'net',
    ];
    echo Gridview::widget([
        'dataProvider' => $providerMkProduction,
        'pjax' => true,
        'pjaxSettings' => ['options' => ['id' => 'kv-pjax-container-mk-production']],
        'panel' => [
            'type' => GridView::TYPE_PRIMARY,
            'heading' => '<span class="glyphicon glyphicon-book"></span> ' . Html::encode('Production'),
        ],
        'export' => false,
        'columns' => $gridColumnMkProduction
    ]);
}
?>

    </div>
   
    <div class="row">
<?php
if($providerMkMisc->totalCount){
    $gridColumnMkMisc = [
        ['class' => 'yii\grid\SerialColumn'],
            ['attribute' => 'id', 'visible' => false],
                        [
                'attribute' => 'company.name',
                'label' => 'Company'
            ],
            'provider_company',
            'description',
            'gross',
            'net',
    ];
    echo Gridview::widget([
        'dataProvider' => $providerMkMisc,
        'pjax' => true,
        'pjaxSettings' => ['options' => ['id' => 'kv-pjax-container-mk-misc']],
        'panel' => [
            'type' => GridView::TYPE_PRIMARY,
            'heading' => '<span class="glyphicon glyphicon-book"></span> ' . Html::encode('Misc'),
        ],
        'export' => false,
        'columns' => $gridColumnMkMisc
    ]);
}
?>

    </div>
   
</div>
