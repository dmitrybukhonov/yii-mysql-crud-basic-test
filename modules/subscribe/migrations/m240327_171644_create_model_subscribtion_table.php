<?php

use yii\db\Migration;

class m240327_171644_create_model_subscribtion_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%model_subscription}}', [
            'id' => $this->primaryKey(),
            'entity_id' => $this->integer()->notNull(),
            'entity' => $this->string()->notNull(),
            'phone' => $this->string(),
            'created_at' => $this->dateTime()->notNull()->defaultExpression('CURRENT_TIMESTAMP'),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%model_subscribtion}}');
    }
}
