<?php

use app\modules\bookcatalog\models\Author;
use yii\db\Migration;

class m240318_152754_create_author_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable(Author::tableName(), [
            'id' => $this->primaryKey(),
            'full_name' => $this->string()->notNull(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable(Author::tableName());
    }
}
