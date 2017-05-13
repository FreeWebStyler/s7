<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\modules\yii2pjax\models\PhpVersion */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Yii2 и Pjax', 'url' => ['/yii2pjax/index']];
$this->params['breadcrumbs'][] = ['label' => 'GridView и Pjax', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => 'Просмотр записи'];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="php-version-view">

    <h1><?= Html::encode($model->version) ?></h1>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'branch:ntext',
            'version:ntext',
            'release_date:ntext',
        ],
    ]) ?>

</div>
