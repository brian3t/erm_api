<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use kartik\grid\GridView;

/* @var $this yii\web\View */
/* @var $model app\models\Venue */

?>
<div class="venue-view">

    <div class="row">
        <div class="col-sm-9">
            <h2><?= Html::encode($model->name) ?></h2>
        </div>
    </div>

    <div class="row">
<?php 
    $gridColumn = [
        ['attribute' => 'id', 'visible' => false],
        'name',
        'venue_type',
        'previous_name',
        'note',
        'ticket_rebate',
        'other_deal',
        'address1',
        'address2',
        'city',
        'state',
        'zipcode',
        'country',
        'timezone',
        'owner',
        [
            'attribute' => 'company.name',
            'label' => 'Company',
        ],
        'general_info_email:email',
        'main_office_phone',
        'box_office_phone',
        'fax_phone',
        'other_phone',
        [
            'attribute' => 'primaryTicketingCompany.name',
            'label' => 'Primary Ticketing Company',
        ],
        'other_seating_capacity',
        'end_stage_seating_capacity',
        'full_stage_seating_capacity',
        'half_stage_seating_capacity',
        'in_the_round_seating_capacity',
        'other_seating_capacity_name',
        'other_seating_capacity_value',
        'webpage',
        'facebook',
        'yahoo',
        'linkedin',
        'twitter',
        'instagram',
        'google',
    ];
    echo DetailView::widget([
        'model' => $model,
        'attributes' => $gridColumn
    ]); 
?>
    </div>
</div>