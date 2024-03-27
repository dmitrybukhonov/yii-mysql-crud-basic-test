<?php

use app\modules\bookcatalog\models\BookAuthor;
use yii\db\Migration;

class m240318_152804_create_book_author_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable(BookAuthor::tableName(), [
            'id' => $this->primaryKey(),
            'book_id' => $this->integer(),
            'author_id' => $this->integer(),
        ]);

        $this->createIndex(
            'idx-book_author-book_id',
            BookAuthor::tableName(),
            'book_id'
        );

        $this->createIndex(
            'idx-book_author-author_id',
            BookAuthor::tableName(),
            'author_id'
        );

        $this->addForeignKey('fk_book_author_book', BookAuthor::tableName(), 'book_id', '{{%book}}', 'id', 'CASCADE');
        $this->addForeignKey('fk_book_author_author', BookAuthor::tableName(), 'author_id', '{{%author}}', 'id', 'CASCADE');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropIndex('idx-book_author-book_id', BookAuthor::tableName());
        $this->dropIndex('idx-book_author-author_id', BookAuthor::tableName());

        $this->dropTable(BookAuthor::tableName());
    }
}