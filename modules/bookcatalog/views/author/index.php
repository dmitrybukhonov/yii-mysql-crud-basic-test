<?php

use yii\web\View;
use yii\helpers\Html;
use yii\grid\GridView;
use yii\grid\ActionColumn;
use yii\data\ActiveDataProvider;

/**
 * @var View $this
 * @var ActiveDataProvider $dataProvider
 */

$this->title = 'Authors';
$this->params['breadcrumbs'][] = $this->title;

?>

<div class="container">
    <?= Html::a(
        'Add',
        ['/bookcatalog/author/create'],
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
        'full_name',
        [
            'class' => ActionColumn::class,
            'template' => '{view} {update} {delete}',
        ],
    ]
]) ?>