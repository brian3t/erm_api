<?php

use yii\helpers\Html;
use kartik\export\ExportMenu;
use kartik\grid\GridView;
use kartik\widgets\SwitchInput;

/* @var $this yii\web\View */
/* @var $searchModel app\models\OrderSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Order';
$this->params['breadcrumbs'][] = $this->title;
$search = "$('.search-button').click(function(){
	$('.search-form').toggle(200);
	return false;
});";
$this->registerJs($search);

?>
<div class="order-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Order', ['create'], ['class' => 'btn btn-success']) ?>
        <?= Html::a('Advance Search', '#', ['class' => 'btn btn-info search-button']) ?>
    </p>
    <div class="search-form" style="display:none">
        <?= $this->render('_search', ['model' => $searchModel]); ?>
    </div>
    <?php

    $gridColumn = [
        ['class' => 'yii\grid\SerialColumn'],
        ['attribute' => 'id', 'hidden' => true],
        [
            'label' => 'MP',
            'attribute' => 'mp.name',
        ],
        [
            'label' => 'MP Ref#',
            'value' => function ($model, $key, $i, $c) {
                return $model->mp_reference_number . "\nItems: " . count($model->orderItems);
            },
        ],
        ['class' => 'kartik\grid\ExpandRowColumn',
            'width' => '50px',
            'value' => function ($model, $key, $index, $column) {
                return GridView::ROW_COLLAPSED;
            },
            'detail' => function ($model, $key, $index, $column) {
                return Yii::$app->controller->renderPartial('_expand', ['model' => $model]);
            },
            'headerOptions' => ['class' => 'kartik-sheet-style'],
            'expandOneOnly' => true
        ],
        'last_mp_updated',
        'last_rop_pull',
        [
            'label' => '#ROP pulled',
            'value' => function ($model, $key, $i, $c) {
                return ($model->count_rop_pull == 0) ? '' : $model->count_rop_pull;
            }
        ],
        'rop_order_id',
        [
            'label' => 'Force ROP resend',
            'format' => 'raw',
            'value' => function ($model, $k, $i, $c) {
                $html = '<label class="control-label"></label>';
                $html .= SwitchInput::widget(['name' => 'force_rop_resend', 'value' => $model->force_rop_resend,
                    'pluginOptions' => ['size' => 'mini',
                        'onSwitchChange' => new \yii\web\JsExpression("
                        function(event, state){
                            var val = (state == true?1:0);
                            $.post('/order/update/?id=" . $model->id . "', {Order:{force_rop_resend:val}});
                    }")],
                ]);
                return $html;
            }
        ],
        'count_rop_pull',
        'channel_date_created',
        // 'shipping_amt',
        // 'tax_amt',
        // 'first_name',
        // 'last_name',
        // 'company',
        // 'email:email',
        // 'address1',
        // 'address2',
        // 'city',
        // 'state_match',
        // 'country_match',
        // 'postal_code',
        // 'gift_message',
        // 'phone',
        // 'ship_first_name',
        // 'ship_last_name',
        // 'ship_company',
        // 'ship_address1',
        // 'ship_address2',
        // 'ship_city',
        // 'ship_state_match',
        // 'ship_country_match',
        // 'ship_postal_code',
        // 'ship_phone',
        // 'pay_type',
        // 'pay_transaction_id',
        // 'comments:ntext',
        [
            'label' => 'Status',
            'format' => 'html',
            'value' => function ($model, $k, $i, $c) {
                $status = $model->status;
                $echo = "<span class='$status'>$status</span>";
                if (count($model->trackings) > 0) {
                    $echo .= '<span class="glyphicon glyphicon-send" aria-hidden="true"></span>';
                }
                return $echo;
            },
            'hAlign' => GridView::ALIGN_CENTER,
        ],
        'product_total',
        'discount_amt',
        'grand_total',
        [
            'class' => 'yii\grid\ActionColumn',
        ],
        ['attribute' => 'customer_id',
            'label' => 'Customer',
            'value' => function ($model) {
                return $model->customer->id;
            },
            'filterType' => GridView::FILTER_SELECT2,
            'filter' => \yii\helpers\ArrayHelper::map(\app\models\Customer::find()->asArray()->all(), 'id', 'id'),
            'filterWidgetOptions' => [
                'pluginOptions' => ['allowClear' => true],
            ],
            'filterInputOptions' => ['placeholder' => 'Customer', 'id' => 'grid-order-search-customer_id']
        ],

    ];
    ?>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => $gridColumn,
        'pjax' => true,
        'pjaxSettings' => ['options' => ['id' => 'kv-pjax-container-order']],
        'panel' => [
            'type' => GridView::TYPE_PRIMARY,
            'heading' => '<span class="glyphicon glyphicon-book"></span>  ' . Html::encode($this->title),
        ],
        // set a label for default menu
        'export' => [
            'label' => 'Page',
            'fontAwesome' => true,
        ],
        // your toolbar can include the additional full export menu
        'toolbar' => [
            '{export}',
            ExportMenu::widget([
                'dataProvider' => $dataProvider,
                'columns' => $gridColumn,
                'target' => ExportMenu::TARGET_BLANK,
                'fontAwesome' => true,
                'dropdownOptions' => [
                    'label' => 'Full',
                    'class' => 'btn btn-default',
                    'itemsBefore' => [
                        '<li class="dropdown-header">Export All Data</li>',
                    ],
                ],
            ]),
        ],
    ]); ?>

</div>
