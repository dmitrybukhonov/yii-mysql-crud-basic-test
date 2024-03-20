<?php

use yii\web\View;
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use app\modules\bookcatalog\models\Author;

/**
 * @var View $this
 * @var ActiveForm $form
 * @var Author $model
 */

$this->title = $model->id ? 'Update author' : 'Add author';
$this->params['breadcrumbs'][] = [
    'label' => 'Authors',
    'url' => [
        '/bookcatalog/author/index',
    ],
];
$this->params['breadcrumbs'][] = $this->title;

?>
<?php $form = ActiveForm::begin(); ?>

<?= $form->field($model, 'full_name') ?>

<?= Html::submitButton('Сохранить', ['class' => 'btn btn-primary']) ?>
<?= Html::a('Вернуться к списку', ['author/index'], ['class' => 'btn btn-default']) ?>

<?php ActiveForm::end(); ?>