<?php

namespace app\modules\subscribe\widgets\model;

use yii\base\Widget;
use yii\bootstrap4\Html;

class ModelSubscriptionWidget extends Widget
{
    public $entity;
    public $entity_id;

    public function run()
    {
        $modalId = 'subscribeModal-' . $this->entity_id;
        $buttonId = 'subscribeButton-' . $this->entity_id;

        $script = <<<JS
            $('#$buttonId').click(function() {
                $('#$modalId').modal('show');
            });
JS;

        $this->getView()->registerJs($script);

        return $this->render('index', [
            'modalId' => $modalId,
            'buttonId' => $buttonId,
            'entityId' => $this->entity_id,
            'entity' => $this->entity,
        ]);
    }
}
