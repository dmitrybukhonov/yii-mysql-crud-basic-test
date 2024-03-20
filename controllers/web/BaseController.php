<?php

namespace app\controllers\web;

use Yii;
use yii\web\Controller;
use yii\web\ErrorAction;
use yii\captcha\CaptchaAction;

class BaseController extends Controller
{
    /**
     * @param string $message
     */
    public function alertDanger(string $message)
    {
        Yii::$app->session->setFlash('error', $message);
    }

    /**
     * @param string $message
     */
    public function alertSuccess(string $message)
    {
        Yii::$app->session->setFlash('success', $message);
    }

    /**
     * {@inheritdoc}
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => ErrorAction::class,
            ],
            'captcha' => [
                'class' => CaptchaAction::class,
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }
}
