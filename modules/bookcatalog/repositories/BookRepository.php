<?php

namespace app\modules\bookcatalog\repositories;

use yii\db\ActiveQuery;
use app\modules\bookcatalog\models\Book;

final class BookRepository
{
    /**
     * @return ActiveQuery
     */
    public function getModel(): ActiveQuery
    {
        return Book::find();
    }
    /**
     * @return array
     */
    public function getAll(): array
    {
        return Book::find()->all();
    }

    /**
     * @param integer $id
     * @return Book|null
     */
    public function getById(int $id): ?Book
    {
        return Book::findOne($id);
    }

    /**
     * @param Book $book
     * @return boolean
     */
    public function save(Book $book): bool
    {
        return $book->save();
    }

    /**
     * @param Book $book
     * @return boolean
     */
    public function delete(Book $book): bool
    {
        return $book->delete();
    }
}
