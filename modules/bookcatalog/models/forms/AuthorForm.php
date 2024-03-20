<?php

namespace app\modules\bookcatalog\models\forms;

use yii\base\Model;
use app\modules\bookcatalog\models\Author;

class AuthorForm extends Model
{
    public $id;
    public $full_name;

    public function __construct(Author $author = null, $config = [])
    {
        if ($author !== null) {
            $this->attributes = $author->attributes;
        }

        parent::__construct($config);
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels(): array
    {
        return [
            'full_name' => 'Full Name',
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function rules(): array
    {
        return [
            [['id'], 'integer'],
            [['full_name'], 'required'],
            [['full_name'], 'string', 'max' => 255],
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

        $author = Author::findOne($this->id);
        if ($author === null) {
            $author = new Author();
        }

        $author->id = $this->id;
        $author->full_name = $this->full_name;

        if ($author->save()) {
            $this->id = $author->id;

            return true;
        }

        return false;
    }
}
