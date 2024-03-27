<?php

use yii\web\View;
use yii\helpers\Html;
use yii\grid\GridView;
use yii\data\ActiveDataProvider;
use app\widgets\grid\ActionColumn;

/**
 * @var View $this
 * @var ActiveDataProvider $dataProvider
 */

$this->title = 'Books';
$this->params['breadcrumbs'][] = $this->title;

?>

<div class="container">
    <?= Html::a(
        'Add book',
        ['/bookcatalog/book/create'],
        [
            'class' => 'btn btn-success',
            'style' => 'margin-bottom: 10px;',
        ]
    ) ?>
</div>
<?= GridView::widget([
    'dataProvider' => $dataProvider,
    'showFooter' => true,
    'tableOptions' => [
        'class' => 'table table-hover table-responsive dataTable',
    ],
    'columns' => [
        'id',
        'title',
        'year',
        'description',
        'isbn',
        [
            'class' => ActionColumn::class,
            'template' => '{view} {update} {delete}',
        ],
    ]
]) ?>