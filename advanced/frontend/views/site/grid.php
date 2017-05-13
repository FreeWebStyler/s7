<?php

use frontend\models\Flight;
use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $searchModel app\modules\simplegridview\models\Category */
/* @var $dataProvider yii\data\ActiveDataProvider */

//$this->title = 'Категории';
//$this->params['breadcrumbs'][] = 'Пример с GridView';

/* @var $this yii\web\View */

$this->title = 'S7';

?>

<div class="category-index">
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>
    <p>
        <?= ''
        //Html::a('Добавить категорию', ['create'], ['class' => 'btn btn-success'])
        ?>
    </p>

<?php
/*echo GridView::widget([
    'dataProvider' => $dataProvider,
    'showHeader' => true,
    'showFooter'=> false,
]);*/
?>
    <?php

    //pred($dataProvider);
    //pred($dataProvider->query->where);
    echo GridView::widget([
        'dataProvider'  => $dataProvider,
        'filterModel'   => $searchModel,
        'showHeader'    => true,
        'showFooter'    => false,
        'emptyCell'     => '-',
        'columns' => [
           // ['class' => 'yii\grid\SerialColumn'],

            'id',
//            'parent.name', // Второй вариант: проще, но без возможности сортировки по полю
            'flight_id',
            //'from',
           //'type',
            [
                 'attribute'=>'type',
                 //'value' => 'billed_meals.type',
                 'value' => function ($model) use($gridSearch, $dataProvider) {
                    //pred($dataProvider);
                    //pred($model);
                    //pred($model->billedMeals);
                    $cells = '';
                    //$cells = '444';

                    #$ar = &$model->billedMeals;
                    //$ar = $model->billedMeals;
                    //pred($model->billedMeals);
                    $c = count($model->billedMeals);
                    $first = 1;
                    for($i=0; $i < $c; $i++){
                        if(isset($gridSearch['type']) && $model->billedMeals[$i]->type != $gridSearch['type']) continue;
                        //pred(33);

                        if($first){ $cells.= $model->billedMeals[$i]->type.'</td></tr>'; $first = 0;}
                        if($i > 0 && $i < $c-1) $cells.='<tr><td>'.$model->id.'</td><td>'.$model->flight_id.'</td><td>'.$model->billedMeals[$i]->type.'</td></tr>';
                        if($i == $c-1) $cells.= '<tr><td style=background:red>'.$model->id.'</td><td>'.$model->flight_id.'</td><td>'.$model->billedMeals[$i]->type;
                    }
                    //pred(gettype($model->billedMeals));
                    //pred($cells);
                    return $cells;
                },
            ],






           /* [
                            'attribute'=>'From',
                            //'value' => 'flight.from',
                            //'label'=>'Родительская категория',
                            'format'=>'text', // Возможные варианты: raw, html
                            'content'=>function($data){
                                return $data->getFrom();
                            },
                            //'filter' => Flight::find()->all()
                            'filter' => Html::activeDropDownList(
                                $searchModel,
                                'id',
                                [1,2,3],
                                ['class' => 'form-control', 'prompt' => 'Все']
                            )
                            'filter' => Html::activeInput('text', $searchModel, 'from', ['class' => 'form-control']),

                        ],*/
                         /*[
                                         'attribute'=>'type',
                                         //'value' => 'billed_meals.type',
                                        //'label'=>'Родительская категория',
                                         'format'=>'text', // Возможные варианты: raw, html
                                         'content'=>function($data){
                                             return $data->getType();
                                         },
                                        'filter' => Html::activeInput('text', $searchModel, 'type', ['name' => 'type', 'class' => 'form-control']),

                                     ],*/


            /*[
                'attribute'=>'parent_id',
                'label'=>'Родительская категория',
                'format'=>'text', // Возможные варианты: raw, html
                'content'=>function($data){
                    return $data->getParentName();
                },
                //'filter' => Category::getParentsList()
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
            ],*/
        ],
        'tableOptions' => [
            'class' => 'table table-striped table-bordered'
        ],
    ]);
    ?>

</div>