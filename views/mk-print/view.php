<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use kartik\grid\GridView;

/* @var $this yii\web\View */
/* @var $model app\models\MkPrint */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Mk Print', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="mk-print-view">

    <div class="row">
        <div class="col-sm-9">
            <h2><?= 'Mk Print'.' '. Html::encode($this->title) ?></h2>
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
            'attribute' => 'marketing.id',
            'label' => 'Marketing',
        ],
        [
            'attribute' => 'company.name',
            'label' => 'Company',
        ],
        'provider_company',
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
    echo DetailView::widget([
        'model' => $model,
        'attributes' => $gridColumn
    ]);
?>
    </div>
    <div class="row">
        <h4>Marketing<?= ' '. Html::encode($this->title) ?></h4>
    </div>
    <?php 
    $gridColumnMarketing = [
        ['attribute' => 'id', 'visible' => false],
        'offer_id',
        'user_id',
        'graphic_artist',
        'newsprint',
        'street_team',
        'billboards',
        'spots',
        'admat',
        'postage',
        'others',
    ];
    echo DetailView::widget([
        'model' => $model->marketing,
        'attributes' => $gridColumnMarketing    ]);
    ?>
    <div class="row">
        <h4>Company<?= ' '. Html::encode($this->title) ?></h4>
    </div>
    <?php 
    $gridColumnCompany = [
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
        'timezone',
        'description',
        'line_of_business',
        'general_email',
        'country',
        'work_phone',
        'fax',
        'webpage',
        'facebook',
        'linkedin_company_page',
        'yahoo',
        'twitter',
        'instagram',
        'google',
        'note',
        'belong_company_id',
    ];
    echo DetailView::widget([
        'model' => $model->company,
        'attributes' => $gridColumnCompany    ]);
    ?>
</div>
