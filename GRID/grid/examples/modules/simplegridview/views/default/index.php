<?php

use app\modules\simplegridview\models\Category;
use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $searchModel app\modules\simplegridview\models\Category */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Категории';
$this->params['breadcrumbs'][] = 'Пример с GridView';
?>
<div class="category-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Добавить категорию', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'showHeader' => true,
        'showFooter'=> false,
//        'emptyCell' => '-',
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
//            'parent.name', // Второй вариант: проще, но без возможности сортировки по полю
            'name',
            [
                'attribute'=>'parent_id',
                'label'=>'Родительская категория',
                'format'=>'text', // Возможные варианты: raw, html
                'content'=>function($data){
                    return $data->getParentName();
                },
                'filter' => Category::getParentsList()
            ],
            [
                'attribute'=>'created_at',
                'label'=>'Создано',
                'format'=>'datetime', //Возможные варианты: date, datetime, time
                'headerOptions' => ['width' => '200'],
            ],
            [
                'attribute' => 'updated_at',
                'format' =>  ['date', 'HH:mm:ss dd.MM.YYYY'],
                'options' => ['width' => '200']
            ],
            [
                'class' => 'yii\grid\ActionColumn',
                'header'=>'Действия',
                'buttons' => [
                    'update' => function ($url,$model) {
                        return Html::a(
                            '<span class="glyphicon glyphicon-screenshot"></span>',
                            $url);
                    },
                    'link' => function ($url,$model,$key) {
                        return Html::a('Action', $url);
                    },
                ],
            ],
            // Простой вариант. Автоматическое формирование изображения
            'categoryImagePath:image',
            // Второй вариант. Формирование изображения и его параметров через анонимную функцию
            [
                'label' => 'Картинка',
                'format' => 'raw',
                'value' => function($data){
                    return Html::img(Url::toRoute($data->category_image),[
                        'alt'=>'yii2 - картинка в gridview',
                        'style' => 'width:15px;'
                    ]);
                },
            ],
            [
                'label' => 'Ссылка',
                'format' => 'raw',
                'value' => function($data){
                    return Html::a(
                        'Перейти',
                        $data->url,
                        [
                            'title' => 'Смелей вперед!',
                            'target' => '_blank'
                        ]
                    );
                }
            ],
        ],
        'tableOptions' => [
            'class' => 'table table-striped table-bordered'
        ],
    ]);
    ?>

</div>
