<?php

use yii\db\Migration;

class m160415_073627_create_books extends Migration
{
    public function safeUp()
    {
        $this->createTable('books', [
            'id' => $this->primaryKey(),
            'name' => $this->string()->notNull(),
            'date_create' => $this->integer()->notNull(),
            'date_update' => $this->integer()->notNull(),
            'preview' => $this->string(),
            'date' => $this->dateTime()->notNull(),
            'author_id' => $this->integer()->notNull(),
        ]);
        
        $this->addForeignKey(
            'fk_books_author',
            'books',
            'author_id',
            'authors',
            'id',
            'CASCADE',
            'CASCADE'
        );
    }

    public function safeDown()
    {
        $this->dropForeignKey('fk_books_author', 'books');
        $this->dropTable('books');
    }
}
