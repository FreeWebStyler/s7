<?php

namespace app\modules\yii2pjax\controllers;

use Yii;
use yii\base\Security;
use yii\web\Controller;

class DefaultController extends Controller
{
    public function actionIndex()
    {
        return $this->render('refresh', ['time' => date('H:i:s')]);
    }

    public function actionAutoRefresh()
    {
        return $this->render('auto-refresh', ['time' => date('H:i:s')]);
    }

    public function actionTime()
    {
        return $this->render('time-date', ['response' => date('H:i:s')]);
    }

    public function actionDate()
    {
        return $this->render('time-date', ['response' => date('d.m.Y')]);
    }

    public function actionMultiple()
    {
        $security = new Security();
        $randomString = $security->generateRandomString();
        $randomKey = $security->generateRandomKey();

        return $this->render('multiple', [
            'randomString' => $randomString,
            'randomKey' => $randomKey,
        ]);
    }

    public function actionFormSubmission()
    {
        $security = new Security();
        $string = Yii::$app->request->post('string');
        $stringHash = '';
        if (!is_null($string)) {
            $stringHash = $security->generatePasswordHash($string);
        }

        return $this->render('form-submission', [
            'stringHash' => $stringHash,
        ]);
    }

    public function actionVote()
    {
        return $this->render('vote');
    }

    public function actionUpvote()
    {
        $votes = Yii::$app->session->get('votes', 0);
        Yii::$app->session->set('votes', ++$votes);

        return $this->render('vote');
    }

    public function actionDownvote()
    {
        $votes = Yii::$app->session->get('votes', 0);
        Yii::$app->session->set('votes', --$votes);

        return $this->render('vote');
    }
}
