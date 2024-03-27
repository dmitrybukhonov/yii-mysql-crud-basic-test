<?php

namespace app\modules\subscribe;

use Yii;
use yii\base\Module as BaseModule;

class Module extends BaseModule
{
    public function init()
    {
        parent::init();

        if (Yii::$app instanceof \yii\web\Application) {
            $this->controllerNamespace = 'app\modules\subscribe\controllers';
        }
    }
}
