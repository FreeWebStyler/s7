<?php

namespace app\modules\simpleactiveform\controllers;


use app\modules\simpleactiveform\models\FormInput;
use yii\web\Controller;

class DefaultController extends Controller
{
    public function actionIndex()
    {
        $model = new FormInput();
        return $this->render('forminput',['model' => $model]);
    }
}
