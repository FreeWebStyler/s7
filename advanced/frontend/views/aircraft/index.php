<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel frontend\models\AircraftSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Aircrafts';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="aircraft-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Aircraft', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'type',
            'name',
            'bortnumber',
            'econom',
            // 'business',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
