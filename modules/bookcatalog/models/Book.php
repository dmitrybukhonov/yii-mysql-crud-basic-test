<?php

namespace app\modules\bookcatalog\models;

use yii\db\ActiveQuery;
use yii\db\ActiveRecord;

/**
 * @property int $id
 * @property string $title
 * @property int|null $year
 * @property string|null $description
 * @property string|null $isbn
 * @property int|null $cover_image_id
 *
 * @property BookAuthor[] $bookAuthors
 * @property Author[] $authors
 * @property Image $coverImage
 */
class Book extends ActiveRecord
{
    public $cover_image;

    /**
     * {@inheritdoc}
     */
    public static function tableName(): string
    {
        return 'book';
    }

    /**
     * @return ActiveQuery
     */
    public function getBookAuthors(): ActiveQuery
    {
        return $this->hasMany(BookAuthor::class, ['book_id' => 'id']);
    }

    /**
     * @return ActiveQuery
     */
    public function getAuthors(): ActiveQuery
    {
        return $this->hasMany(Author::class, ['id' => 'author_id'])->via('bookAuthors');
    }

    // /**
    //  * @return \yii\db\ActiveQuery
    //  */
    // public function getCoverImage()
    // {
    //     return $this->hasOne(Image::class, ['id' => 'cover_image_id']);
    // }
}
