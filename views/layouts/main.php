<?php

/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use app\assets\AppAsset;

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
    <link rel="stylesheet"
          href="http://<?= Yii::$app->request->serverName . "/" . Yii::$app->request->baseUrl ?>/less/stylesheets/custom.css">
</head>
<body>
<?php $this->beginBody() ?>

<div class="wrap">
    <?php
    NavBar::begin([
        'brandLabel' => Html::img('@web/img/logo.png'),
        'brandUrl' => Yii::$app->homeUrl,
        'options' => [
            'class' => 'navbar navbar-fixed-top',
        ],
    ]);
    echo '<span class="navbar-brand">v0.6</span>';
    echo Nav::widget([
        'options' => ['class' => 'navbar-nav navbar-right'],
        'items' => [
            ['label' => 'Orders', 'url' => ['/order/index']],
            ['label' => 'Customers', 'url' => ['/customer/index']],
            ['label' => 'Docs', 'url' => ['/docs']],
            ['label' => 'Events', 'url' => ['/event']],
            ['label' => 'Inventory', 'url' => ['/inventory']],
            [
                'label' => 'Reports',
                'items' => [
                    '<li class="dropdown-header">Order</li>',
                    ['label' => 'Order confirmation %', 'url' => \yii\helpers\Url::to('/order/confirm-percent')],
                    '<li class="divider"></li>',
                    '<li class="dropdown-header">Performance</li>',
                    ['label' => 'Task duration', 'url' => '#'],
                ],
            ],
            [
                'label' => 'Users',
                'items' => [
                    '<li class="dropdown-header">Order</li>',
                    ['label' => 'Admin', 'url' => '/user/admin/index'],
                    // '<li class="divider"></li>',
                    // '<li class="dropdown-header">Performance</li>',
                    // ['label' => 'Task duration', 'url' => '#'],
                ],
            ],

            ['label' => 'Orders w/ROP', 'url' => ['/order?has_rop=1']],
            ['label' => 'API Order', 'url' => 'http://api.' . Yii::$app->request->serverName . '/v1/order'],
           Yii::$app->user->isGuest ? (
               ['label' => 'Login', 'url' => ['/user/security/login']]
           ) : (
               '<li>'
               . Html::beginForm(['/site/logout'], 'post')
               . Html::submitButton(
                   'Logout (' . Yii::$app->user->identity->username . ')',
                   ['class' => 'btn btn-link']
               )
               . Html::endForm()
               . '</li>'
           )
        ],
    ]);
    ?>
    
    <?php
    NavBar::end();
    ?>

    <div class="container">
        <?= Breadcrumbs::widget([
            'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
        ]) ?>
        <?= $content ?>
    </div>
</div>

<footer class="footer">
    <div class="container">
        <p class="pull-left">&copy; Shoe Metro Enhancer 3 <?= date('Y') ?></p>

    </div>
</footer>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
