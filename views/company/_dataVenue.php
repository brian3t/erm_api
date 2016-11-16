<?php
use kartik\grid\GridView;
use yii\data\ArrayDataProvider;

    $dataProvider = new ArrayDataProvider([
        'allModels' => $model->venues,
        'key' => 'id'
    ]);
    $gridColumns = [
        ['class' => 'yii\grid\SerialColumn'],
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
                'general_info_email:email',
        'main_office_phone',
        'box_office_phone',
        'fax_phone',
        'other_phone',
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
        [
            'class' => 'yii\grid\ActionColumn',
            'controller' => 'venue'
        ],
    ];
    
    echo GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => $gridColumns,
        'containerOptions' => ['style' => 'overflow: auto'],
        'pjax' => true,
        'beforeHeader' => [
            [
                'options' => ['class' => 'skip-export']
            ]
        ],
        'export' => [
            'fontAwesome' => true
        ],
        'bordered' => true,
        'striped' => true,
        'condensed' => true,
        'responsive' => true,
        'hover' => true,
        'showPageSummary' => false,
        'persistResize' => false,
    ]);
