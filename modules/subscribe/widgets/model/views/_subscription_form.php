<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use app\modules\subscribe\forms\ModelSubscriptionForm;

$model = new ModelSubscriptionForm();

$form = ActiveForm::begin([
    'action' => ['/subscribe/subscribe/subscribe-model'],
    'enableAjaxValidation' => true,
    'options' => [
        'id' => 'subscribe-form-' . $entityId,
    ],
]);

echo $form->field($model, 'entity_id')->hiddenInput(['value' => $entityId])->label(false);
echo $form->field($model, 'entity')->hiddenInput(['value' => $entity])->label(false);
echo $form->field($model, 'phone')->textInput(['maxlength' => true, 'placeholder' => 79278092335]);

echo Html::submitButton('Subscribe', ['class' => 'btn btn-primary']);

ActiveForm::end();
