<?php

use yii\db\Migration;
use app\modules\bookcatalog\models\Book;

class m240318_152738_create_book_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable(Book::tableName(), [
            'id' => $this->primaryKey(),
            'title' => $this->string()->notNull(),
            'year' => $this->integer(),
            'description' => $this->text(),
            'isbn' => $this->string(20),
            'cover_image_id' => $this->integer(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable(Book::tableName());
    }
}
