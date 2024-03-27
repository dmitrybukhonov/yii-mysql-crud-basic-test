<?php

use yii\web\View;
use yii\helpers\Html;
use yii\widgets\DetailView;
use app\modules\bookcatalog\models\Book;
use app\modules\image\helpers\ImageHelper;

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
        [
            'attribute' => 'cover_image',
            'format' => 'raw',
            'value' => function ($book) {
                return Html::img(
                    ImageHelper::getImageUrl($book, 'cover_image_id'),
                    [
                        'class' => 'img-thumbnail',
                        'style' => 'width: 200px; height: 300px;'
                    ]
                );
            },
        ],
    ],
]) ?>