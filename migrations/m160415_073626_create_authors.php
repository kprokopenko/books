<?php

use yii\db\Migration;

class m160415_073626_create_authors extends Migration
{
    public function up()
    {
        $this->createTable('authors', [
            'id' => $this->primaryKey(),
            'first_name' => $this->string()->notNull(),
            'last_name' => $this->string()->notNull(),
        ]);
    }

    public function down()
    {
        $this->dropTable('authors');
    }
}
