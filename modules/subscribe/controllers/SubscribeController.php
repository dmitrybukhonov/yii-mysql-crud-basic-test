<?php

namespace app\modules\subscribe\controllers;

use Yii;
use app\controllers\web\BaseController;
use app\modules\subscribe\models\ModelSubscription;
use app\modules\subscribe\forms\ModelSubscriptionForm;

class SubscribeController extends BaseController
{
    public function actionSubscribeModel()
    {
        $model = new ModelSubscriptionForm();

        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            $subscription = new ModelSubscription();
            $subscription->entity_id = $model->entity_id;
            $subscription->entity = $model->entity;
            $subscription->phone = $model->phone;

            if ($subscription->save()) {
                Yii::$app->session->setFlash('success', 'You have successfully subscribed to this author.');
            }
        }

        return $this->redirect(Yii::$app->request->referrer);
    }
}
