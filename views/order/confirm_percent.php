<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use kartik\grid\GridView;

\app\assets\ChartAsset::register($this);
/* @var $this yii\web\View */
/* @var $model app\models\Order */

$this->title = "Confirmation Percentage";
$this->params['breadcrumbs'][] = ['label' => 'Order', 'url' => ['Confirmation Percentage']];
?>
<div class="order-view">
    
    <div class="search-form" style="display:none">
        <?= $this->render('_search', ['model' => $searchModel]); ?>
    </div>

    <div class="row">
        <div id="container" style="margin: 0 auto"></div>
    </div>
</div>

<?php
$this->registerJs("
    $(function () {
        $('#container').highcharts({
            chart: {
                type: 'area'
            },
            title: {
                text: 'Percent of Orders that were confirmed from ROP versus outstanding'
            },
            subtitle: {
                text: '04/15/2016'
            },
            xAxis: {
                categories: ['04-09', '04-10', '04-11', '04-12', '04-13', '04-14', '04-15'],
                tickmarkPlacement: 'on',
                title: {
                    enabled: false
                }
            },
            yAxis: {
                title: {
                    text: 'Percent'
                }
            },
            tooltip: {
                pointFormat: '<span style=\"color:{series.color}\">{series.name}</span>: <b>{point.percentage:.1f}%</b> ({point.y:,.0f} orders)<br/>',
                shared: true
            },
            plotOptions: {
                area: {
                    stacking: 'percent',
                    lineColor: '#ffffff',
                    lineWidth: 1,
                    marker: {
                        lineWidth: 1,
                        lineColor: '#ffffff'
                    }
                }
            },
            series: [{
                name: 'Outstanding',
                data: [50, 63, 80, 94, 140, 364, 526]
            }, {
                name: 'Confirmed',
                data: [10, 17, 11, 13, 21, 76, 176]
            }]
        });
    });
", $this::POS_END);