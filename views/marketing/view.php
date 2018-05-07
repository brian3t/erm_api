<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Marketing */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Marketing', 'url' => ['index']];
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
        'created_at',
        'updated_at',
        'radio',
        'tv',
        'graphic_artist',
        'newsprint',
        'internet',
        'street_team',
        'printing',
        'billboards',
        'spots',
        'admat',
        'postage',
        'others',
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
        'event_id',
        'status',
    ];
    echo DetailView::widget([
        'model' => $model->offer,
        'attributes' => $gridColumnOffer    ]);
    ?>
</div>
