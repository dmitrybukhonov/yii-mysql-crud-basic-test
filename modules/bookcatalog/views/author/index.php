<?php

use yii\web\View;
use yii\helpers\Html;
use yii\grid\GridView;
use yii\data\ActiveDataProvider;
use app\widgets\grid\ActionColumn;
use app\modules\subscribe\widgets\model\ModelSubscriptionWidget;

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
            'template' => '{view} {update} {delete} {subscribe}', // Добавляем кнопку подписки
            'buttons' => [
                'subscribe' => function ($url, $model, $key) {
                    return ModelSubscriptionWidget::widget([
                        'entity_id' => $model->id,
                        'entity' => get_class($model),
                    ]);
                },
            ],
        ],
    ]
]) ?>