<?php

use app\modules\simplegridview\models\Category;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\modules\simplegridview\models\Category */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="category-form">

    <?php $form = ActiveForm::begin([
        'options' => [
            'enctype' => 'multipart/form-data'
        ]
    ]);
    ?>

    <?= $form->field($model, 'parent_id')->dropDownList(Category::getCategoriesList(),['prompt' => 'Выберите родительскую категорию...']) ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'url')->textInput(['maxlength' => true]) ?>
    <?php if (!$model->isNewRecord): ?>
        <?= Html::label('Текущая картинка') ?>
        <?= Html::img($model->categoryImagePath) ?>
        <?= $form->field($model, 'tmpImage')->fileInput()->label('Заменить картинку') ?>
    <?php else: ?>
        <?= $form->field($model, 'tmpImage')->fileInput()->label('Картинка категории') ?>
    <?php endif ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Создать' : 'Обновить',
            ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
