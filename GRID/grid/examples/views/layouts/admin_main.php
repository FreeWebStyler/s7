<?php
use yii\helpers\Html;
use kartik\sidenav\SideNav;
use yii\widgets\Breadcrumbs;
use app\assets\AppAsset;
use app\widgets\GoogleAds;

/* @var $this \yii\web\View */
/* @var $content string */

AppAsset::register($this);
rmrevin\yii\fontawesome\AssetBundle::register($this);
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
</head>

<body>
<?php $this->beginBody() ?>
<div id="wrapper">

    <!-- Navigation -->
    <nav class="navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom: 0">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="<?= \yii\helpers\Url::toRoute('/')?>">Yii 2 Framework. Примеры использования</a>
        </div>
        <!-- /.navbar-header -->
        <?php
        echo SideNav::widget([
            'containerOptions' => [
                'class' => 'navbar-default sidebar',
                'role' => 'navigation'
            ],
            'type' => SideNav::TYPE_DEFAULT,
            'items' => [
                ['label' => 'GridView', 'url' => ['/simplegridview/index'],'icon' => 'list'],
                [
                    'label' => 'Yii2 и Pjax',
                    'icon' => 'tasks',
                    'items' => [
                        [
                            'label' => 'Обновление',
                            'url' => \yii\helpers\Url::toRoute('/yii2pjax/index'),
                            'icon' => 'repeat',
                        ],
                        [
                            'label' => 'Авто обновление',
                            'url' => \yii\helpers\Url::toRoute('/yii2pjax/auto-refresh'),
                            'icon' => 'refresh',
                        ],
                        [
                            'label' => 'Дата/Время',
                            'url' => \yii\helpers\Url::toRoute('/yii2pjax/time'),
                            'icon' => 'time',
                        ],
                        [
                            'label' => 'Разные данные',
                            'url' => \yii\helpers\Url::toRoute('/yii2pjax/multiple'),
                            'icon' => 'random',
                        ],
                        [
                            'label' => 'Формы',
                            'url' => \yii\helpers\Url::toRoute('/yii2pjax/form-submission'),
                            'icon' => 'credit-card',
                        ],
                        [
                            'label' => 'Голосовалка',
                            'url' => \yii\helpers\Url::toRoute('/yii2pjax/vote'),
                            'icon' => 'ok',
                        ],
                        [
                            'label' => 'Yii2 GridView и pjax',
                            'url' => \yii\helpers\Url::toRoute('/yii2pjax/php-version/index'),
                            'icon' => 'calendar',
                        ]
                    ]
                ],
                ['label' => 'Поля ActiveForm', 'url' => ['/simpleactiveform/index'],'icon'=>'list-alt'],
            ]
        ]);
        ?>
    </nav>

    <div id="page-wrapper">
        <?= Breadcrumbs::widget([
            'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
        ]) ?>
        <?= $content ?> 
    </div>
    <!-- /#page-wrapper -->
    <footer class="footer">
        <div class="container">
            <p class="pull-left">&copy; <a href="http://nix-tips.ru">Nix-tips.ru</a> <?= date('Y') ?></p>
            <p class="pull-right"><?= Yii::powered() ?></p>
        </div>
    </footer>

</div>
<!-- /#wrapper -->
<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>