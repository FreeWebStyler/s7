<?php
/**
 * Created by PhpStorm.
 * User: nix
 * Date: 12.06.2015
 * Time: 11:42
 */
use yii\bootstrap\ActiveForm;
use yii\helpers\Html;

$this->title = 'Поля ActiveForm';
$this->params['breadcrumbs'][] = $this->title;
?>


<div class="container">
    <div class="panel panel-primary">
        <div class="panel-heading">
            <h1><?= Html::encode($this->title) ?></h1>
        </div>
        <div class="panel-body">
            <?php
            $form = ActiveForm::begin([
                'id' => 'form-input-example',
                'options' => [
                    'class' => 'form-horizontal col-lg-11',
                    'enctype' => 'multipart/form-data'
                ],
            ]);
            ?>
            <?= $form->field($model, 'text')
                ->textInput()
                ->hint('Введите любой текст')
                ->label('Текстовое поле') ?>
            <?= $form->field($model, 'textArea')
                ->textarea(['rows' => 2, 'cols' => 5])
                ->label('Многострочное текстовое поле') ?>
            <?= $form->field($model, 'password')
                ->passwordInput()
                ->hint('Длинна пароля не меньше 10 символов.') ?>
            <?= $form->field($model, 'email')->input('email') ?>
            <?= $form->field($model, 'fileUpload')->fileInput() ?>
            <?= $form->field($model, 'filesUpload[]')
                ->fileInput(['multiple' => 'multiple']) ?>
            <?= $form->field($model, 'checkbox')
                ->checkbox([
                    'label' => 'Неактивный чекбокс',
                    'labelOptions' => [
                        'style' => 'padding-left:20px;'
                    ],
                    'disabled' => true
                ]) ?>
            <?= $form->field($model, 'checkboxList')
                ->checkboxList([
                    'a' => 'Элемент А',
                    'б' => 'Элемент Б',
                    'в' => 'Элемент В',
                ]) ?>
            <?= $form->field($model, 'radioButton')
                ->radio([
                    'label' => 'Радио кнопка',
                    'labelOptions' => [
                        'style' => 'padding-left:20px;'
                    ]
                ]) ?>
            <?= $form->field($model, 'radioButtonList')
                ->radioList([
                    '1' => 'Первый',
                    '2' => 'Второй',
                    '3' => 'Третий'
                ]) ?>
            <?= $form->field($model, 'listBox')
                ->listBox([
                    '1' => '1',
                    2 => '2',
                    '3' => 3,
                    4 => 4,
                    5 => 5
                ],
                    [
                        'multiple' => true,
                        'prompt' => 'Выберите один или несколько вариантов',
                        'style' => 'background:gray;color:#fff;'
                    ]) ?>
            <?= $form->field($model, 'dropdownList')
                ->dropDownList([
                    'А' => 'Вариант А',
                    'Б' => 'Вариант Б',
                    'В' => 'Вариант В',
                ],
                    [
                        'prompt' => 'Выберите один вариант'
                    ]) ?>

            <?= Html::submitButton('Сохранить', ['class' => 'btn btn-primary']) ?>

            <?php ActiveForm::end(); ?>
        </div>
    </div>
<!--    <div class="forminput-form">-->
<!--        -->
<!--    </div>-->