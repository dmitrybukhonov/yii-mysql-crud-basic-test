<?php

use yii\db\Migration;
use app\modules\image\models\Image;

class m240318_153242_create_images_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable(Image::tableName(), [
            'id' => $this->primaryKey(),
            'entity_id' => $this->integer()->notNull(),
            'entity' => $this->string()->notNull(),
            'path' => $this->string()->notNull(),
            'filename' => $this->string()->notNull(),
            'mime_type' => $this->string(),
            'width' => $this->integer(),
            'height' => $this->integer(),
            'file_size' => $this->integer(),
            'created_at' => $this->dateTime()->notNull()->defaultExpression('CURRENT_TIMESTAMP'),
        ]);

        $this->createIndex(
            'idx-image-entity_id',
            Image::tableName(),
            'entity_id'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropIndex('idx-image-entity_id', Image::tableName());
        $this->dropTable(Image::tableName());
    }
}
