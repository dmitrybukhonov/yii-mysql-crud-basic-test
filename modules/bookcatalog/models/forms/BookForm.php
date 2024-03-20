<?php

namespace app\modules\bookcatalog\models\forms;

use yii\base\Model;
use app\modules\bookcatalog\models\Book;
use app\modules\bookcatalog\models\Author;
use app\modules\image\services\SingleImageUpload;

class BookForm extends Model
{
    public $id;
    public $title;
    public $year;
    public $cover_image_id;
    public $description;
    public $isbn;
    public $cover_image;
    public $author_list = [];

    public function __construct(Book $book = null, $config = [])
    {
        if ($book !== null) {
            $this->attributes = $book->attributes;
            $this->author_list = $book->getAuthors()->select('id')->column();
        }

        parent::__construct($config);
    }

    /**
     * @return array
     */
    public function attributeLabels(): array
    {
        return [
            'title' => 'Название',
            'year' => 'Год выпуска',
            'description' => 'Описание',
            'isbn' => 'ISBN',
            'author_list' => 'Авторы',
            'cover_image' => 'Обложка книги',
        ];
    }

    /**
     * @return array
     */
    public function rules(): array
    {
        return [
            [['title'], 'required'],
            [['description'], 'string'],
            [['year', 'cover_image_id', 'id'], 'integer'],
            [['title', 'isbn'], 'string', 'max' => 255],
            ['year', 'compare', 'compareValue' => 1800, 'operator' => '>=', 'message' => 'Год должен быть не менее 1800'],
            ['year', 'compare', 'compareValue' => date('Y'), 'operator' => '<=', 'message' => 'Год не может быть в будущем'],
            ['isbn', 'match', 'pattern' => '/^\d{3}-\d{10}$/', 'message' => 'ISBN must be in the format XXX-XXXXXXXXXX.'],
            [['author_list', 'cover_image'], 'safe'],
        ];
    }

    /**
     * @return boolean
     */
    public function save(): bool
    {
        if (!$this->validate()) {
            return false;
        }

        $book = Book::findOne($this->id);
        if ($book === null) {
            $book = new Book();
        }

        $book->title = $this->title;
        $book->year = $this->year;
        $book->description = $this->description;
        $book->isbn = $this->isbn;

        if ($book->save()) {
            $this->id = $book->id;

            if ($this->saveAuthors($book) && $this->saveCoverImage($book)) {
                $book->cover_image_id = $this->cover_image;

                return $book->save();
            }
        }

        return false;
    }

    /**
     * @param Book $book
     * @return boolean
     */
    private function saveCoverImage(Book $book): bool
    {
        return (new SingleImageUpload($this, get_class($book), 'cover_image'))->saveImage();
    }

    /**
     * @param Book $book
     * @return boolean
     */
    private function saveAuthors(Book $book): bool
    {
        $book->unlinkAll('authors', true);

        foreach ($this->author_list as $authorId) {
            $author = Author::findOne($authorId);
            if ($author !== null) {
                $book->link('authors', $author);
            }
        }

        return true;
    }
}
