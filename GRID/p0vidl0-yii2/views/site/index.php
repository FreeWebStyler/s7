<?php

/* @var $this yii\web\View */

use yii\helpers\Url;

$this->title = Yii::$app->name;
?>
<div class="site-index">

    <div class="jumbotron">
        <h1>Поздравляю!</h1>

        <p class="lead">Вы установили простое приложение, иллюстрирующее работу с GridView.</p>

        <p><a class="btn btn-lg btn-success" href="<?= Url::to(['person/index']) ?>">Начнем</a></p>
    </div>

    <div class="body-content">

        <div class="row">
            <div class="col-lg-4">
                <h2>Страны</h2>

                <p>Для полной работоспособности, первым делом, нужно добавить несколько стран в соответствующую таблицу.</p>

                <p><a class="btn btn-default" href="<?= Url::to(['country/index']) ?>">Добавить страны &raquo;</a></p>
            </div>
            <div class="col-lg-4">
                <h2>Люди</h2>

                <p>Теперь можно создать людей и увидеть всю мощь кастомных фильтров и сортировки по связанным данным.</p>

                <p><a class="btn btn-default" href="<?= Url::to(['person/index']) ?>">Управление людьми &raquo;</a></p>
            </div>
            <div class="col-lg-4">
                <h2>Описание</h2>

                <p>Подробности работы кастомных фильтров в GridView по связанным данным можно найти в коде приложения
                    и в статье по ссылке ниже.</p>

                <p><a class="btn btn-default" href="http://nix-tips.ru/yii2-sortirovka-i-filtr-gridview-po-svyazannym-i-vychislyaemym-polyam.html">Читать описание &raquo;</a></p>
            </div>
        </div>

    </div>
</div>
