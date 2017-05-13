<?php

namespace app\modules\yii2pjax;

use Yii;

class Module extends \yii\base\Module
{
    public $controllerNamespace = 'app\modules\yii2pjax\controllers';

    public function init()
    {
        parent::init();

        Yii::configure($this, require('config/config.php'));
    }
}
