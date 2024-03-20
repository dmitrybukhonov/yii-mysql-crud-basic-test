<?php

namespace app\modules\image;

use Yii;
use yii\helpers\FileHelper;
use yii\base\Module as BaseModule;

class Module extends BaseModule
{
    public function init()
    {
        parent::init();

        $storagePath = Yii::getAlias('@webroot/storage');
        if (!file_exists($storagePath)) {
            FileHelper::createDirectory($storagePath);
        }
    }
}
