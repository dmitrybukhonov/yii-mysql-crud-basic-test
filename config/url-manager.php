<?php

use yii\web\UrlNormalizer;

return [
    'class' => \yii\web\UrlManager::class,
    'enablePrettyUrl' => true,
    'showScriptName' => false,
    'normalizer' => [
        'class' => UrlNormalizer::class,
        'action' => UrlNormalizer::ACTION_REDIRECT_PERMANENT,
    ],
    'rules' => [
        /** Главная */
        '/' => 'site/index',
    ],
];
