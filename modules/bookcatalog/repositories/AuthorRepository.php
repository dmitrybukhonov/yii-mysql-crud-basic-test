<?php

namespace app\modules\bookcatalog\repositories;

use yii\db\Query;
use yii\db\Expression;
use yii\db\ActiveQuery;
use app\modules\bookcatalog\models\Author;
use app\modules\bookcatalog\models\BookAuthor;

final class AuthorRepository
{
    /**
     * @return ActiveQuery
     */
    public function getModel(): ActiveQuery
    {
        return Author::find();
    }

    /**
     * @return array
     */
    public function getAll(): array
    {
        return Author::find()->all();
    }

    /**
     * @return array
     */
    public function getAuthorsForDropdown(): array
    {
        return Author::find()->select('full_name')->indexBy('id')->column();
    }

    /**
     * @param integer $id
     * @return Author|null
     */
    public function getById(int $id): ?Author
    {
        return Author::findOne($id);
    }

    /**
     * @param integer $id
     * @return array 
     */
    public function getTop(int $limit = 10): array
    {
        $topAuthors = (new Query())
            ->select([
                'full_name' => 'author.full_name',
                'book_count' => new Expression('COUNT(book_author.id)')
            ])
            ->from(['author' => Author::tableName()])
            ->leftJoin(['book_author' => BookAuthor::tableName()], 'author.id = book_author.author_id')
            ->groupBy('author.id')
            ->orderBy(['book_count' => SORT_DESC])
            ->limit($limit)
            ->all();

        return $topAuthors;
    }

    /**
     * @param Author $author
     * @return boolean
     */
    public function save(Author $author): bool
    {
        return $author->save();
    }

    /**
     * @param Author $author
     * @return boolean
     */
    public function delete(Author $author): bool
    {
        return $author->delete();
    }
}
