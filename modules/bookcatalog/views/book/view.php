<?php

use yii\web\View;
use yii\helpers\Html;
use app\models\book\Book;
use yii\widgets\DetailView;

/**
 * @var View $this
 * @var Book $book
 */

$this->title = $book->title . ' ' . $book->year;
$this->params['breadcrumbs'][] = [
    'label' => 'Books',
    'url' => [
        '/bookcatalog/book/index',
    ],
];
$this->params['breadcrumbs'][] = $this->title;

?>

<h1>
    <?= Html::encode($this->title) ?>
</h1>
<?= DetailView::widget([
    'model' => $book,
    'attributes' => [
        'id',
        'title',
        'year',
        'description',
        'isbn',
    ],
]) ?>