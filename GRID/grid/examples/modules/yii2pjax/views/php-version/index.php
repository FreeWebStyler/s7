<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $searchModel app\modules\yii2pjax\models\PhpVersionSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Сортировка, фильтрация и пагинация GridView при помощи Pjax';
$this->params['breadcrumbs'][] = ['label' => 'Yii2 и Pjax', 'url' => ['/yii2pjax/index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="php-version-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <h2>Версии PHP</h2>

    <?php Pjax::begin(); ?>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'layout' => '{summary}{items}{pager}',
        'summary' => 'Показаны записи <strong>{begin}-{end}</strong> из <strong>{totalCount}</strong>.',
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            'id',
            'branch:ntext',
            'version:ntext',
            'release_date:ntext',
            [
                'class' => 'yii\grid\ActionColumn',
                'template' => '{view}',
            ],
        ],
    ]); ?>
    <?php Pjax::end(); ?>

    <hr/>
    <p>
        views\php-version\index.php:<br>
        <pre style="background:rgba(238,238,238,0.92);color:#000">&lt;?php <span
                style="color:#33f;font-weight:700">Pjax</span><span style="color:#00f">::</span>begin(); ?>
&lt;?= <span style="color:#33f;font-weight:700">GridView</span><span style="color:#00f">::</span>widget([
    <span style="color:#093">'dataProvider'</span> <span style="color:#00f">=></span> $dataProvider,
    <span style="color:#093">'filterModel'</span> <span style="color:#00f">=></span> $searchModel,
    <span style="color:#093">'columns'</span> <span style="color:#00f">=></span> [
        [<span style="color:#093">'class'</span> <span style="color:#00f">=></span> <span style="color:#093">'yii\grid\SerialColumn'</span>],

        <span style="color:#093">'id'</span>,
        <span style="color:#093">'branch:ntext'</span>,
        <span style="color:#093">'version:ntext'</span>,
        <span style="color:#093">'release_date:ntext'</span>,

        [
            <span style="color:#093">'class'</span> <span style="color:#00f">=></span> <span style="color:#093">'yii\grid\ActionColumn'</span>,
            <span style="color:#093">'template'</span> <span style="color:#00f">=></span> <span style="color:#093">'{view}'</span>,
        ],
    ],
]); ?>
&lt;?php <span style="color:#33f;font-weight:700">Pjax</span><span style="color:#00f">::</span>end(); ?>
</pre>
    </p>
</div>
