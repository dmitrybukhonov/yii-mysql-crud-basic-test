<?php

use yii\web\View;
use yii\helpers\Html;
use yii\widgets\DetailView;
use app\modules\bookcatalog\models\Author;

/**
 * @var View $this
 * @var Author $author
 */

$this->title = $author->id . ' - ' . $author->full_name;
$this->params['breadcrumbs'][] = [
    'label' => 'Books',
    'url' => [
        '/bookcatalog/author/index',
    ],
];
$this->params['breadcrumbs'][] = $this->title;

?>

<h1>
    <?= Html::encode($this->title) ?>
</h1>
<?= DetailView::widget([
    'model' => $author,
    'attributes' => [
        'id',
        'full_name',
    ],
]) ?>