<?php

use yii\web\View;
use yii\helpers\Html;
use kartik\select2\Select2;
use yii\bootstrap\ActiveForm;
use app\modules\bookcatalog\models\forms\BookForm;

/**
 * @var View $this
 * @var ActiveForm $form
 * @var BookForm $model
 * @var array $authorList
 */

$this->title = $model->id ? 'Update book' : 'Add book';
$this->params['breadcrumbs'][] = [
    'label' => 'Books',
    'url' => [
        '/bookcatalog/book/index',
    ],
];
$this->params['breadcrumbs'][] = $this->title;

?>
<?php $form = ActiveForm::begin([
    'options' => [
        'enctype' => 'multipart/form-data',
    ],
]); ?>

<?= $form->field($model, 'title') ?>
<?= $form->field($model, 'year') ?>
<?= $form->field($model, 'description') ?>
<?= $form->field($model, 'isbn') ?>
<?= $form->field($model, 'cover_image_id')->label('ID изображения обложки')->textInput(['readonly' => true]) ?>
<?= $form->field($model, 'cover_image')->fileInput() ?>
<?= $form->field($model, 'author_list')->widget(Select2::class, [
    'data' => $authorList,
    'options' => ['placeholder' => 'Выберите автора ...', 'multiple' => true],
    'pluginOptions' => [
        'tags' => true,
        'tokenSeparators' => [',', ' '],
        'maximumInputLength' => 10
    ],
]) ?>


<?= Html::submitButton('Сохранить', ['class' => 'btn btn-primary']) ?>
<?= Html::a('Вернуться к списку', ['book/index'], ['class' => 'btn btn-default']) ?>

<?php ActiveForm::end(); ?>