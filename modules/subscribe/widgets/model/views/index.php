<?php

use yii\helpers\Html;

?>

<!-- Модальное окно -->
<div class="modal fade" id="<?= $modalId ?>" tabindex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalLabel">Subscribe to Author</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <?= $this->render('_subscription_form', [
                    'entity' => $entity,
                    'entityId' => $entityId,
                ]) ?>
            </div>
        </div>
    </div>
</div>

<!-- Кнопка подписки -->
<?= Html::button('Subscribe', [
    'id' => $buttonId,
    'class' => 'btn btn-primary',
]) ?>