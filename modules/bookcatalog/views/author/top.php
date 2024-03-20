<?php

use yii\web\View;
use yii\helpers\Html;
use yii\data\ActiveDataProvider;

/**
 * @var View $this
 * @var ActiveDataProvider $dataProvider
 */

$this->title = 'Authors';
$this->params['breadcrumbs'][] = $this->title;

?>

<table class="table">
    <thead>
        <tr>
            <th>Author</th>
            <th>Number of Books</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($topAuthors as $author) : ?>
            <tr>
                <td><?= Html::encode($author['full_name']) ?></td>
                <td><?= $author['book_count'] ?></td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>