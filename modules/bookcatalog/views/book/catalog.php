<?php

use yii\web\View;
use yii\helpers\Html;
use yii\data\ActiveDataProvider;
use app\modules\image\helpers\ImageHelper;

/**
 * @var View $this
 * @var ActiveDataProvider $dataProvider
 */

$this->title = 'Authors';
$this->params['breadcrumbs'][] = $this->title;

?>
<div class="container">
    <div class="row">
        <?php foreach ($dataProvider->models as $book) : ?>
            <div class="col-md-4">
                <div class="card mb-4 shadow-sm">
                    <div class="card-body">
                        <?= Html::a(
                            Html::encode($book->title),
                            ['/bookcatalog/book/view', 'id' => $book->id],
                            ['class' => 'card-link']
                        ) ?>
                        <p class="card-year">
                            <?= Html::encode($book->year) ?>
                        </p>
                        <p class="card-description">
                            <?= Html::encode($book->description) ?>
                        </p>
                        <p class="card-description">
                            <?= Html::img(
                                ImageHelper::getImageUrl($book, 'cover_image_id'),
                                [
                                    'class' => 'img-thumbnail',
                                    'style' => 'width: 200px; height: 300px;'
                                ]
                            ) ?>
                        </p>
                        <h6 class="card-isbn">
                            <?= Html::encode($book->isbn) ?>
                        </h6>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</div>