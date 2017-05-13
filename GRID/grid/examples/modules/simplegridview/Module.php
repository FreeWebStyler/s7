<?php

namespace app\modules\simplegridview;

use Yii;

class Module extends \yii\base\Module
{
    public $controllerNamespace = 'app\modules\simplegridview\controllers';

    public function init()
    {
        parent::init();

        Yii::configure($this, require('config/config.php'));
    }
}
