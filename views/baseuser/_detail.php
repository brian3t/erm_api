<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use kartik\grid\GridView;

/* @var $this yii\web\View */
/* @var $model app\models\base\User */

?>
<div class="user-view">

    <div class="row">
        <div class="col-sm-9">
            <h2><?= Html::encode($model->username) ?></h2>
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
        'attributes' => $gridColumn
    ]); 
?>
    </div>
</div>