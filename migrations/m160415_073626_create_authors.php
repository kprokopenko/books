<?php

use yii\db\Migration;

class m160415_073626_create_authors extends Migration
{
    public function up()
    {
        $this->createTable('authors', [
            'id' => $this->primaryKey(),
            'first_name' => $this->string(),
            'last_name' => $this->string(),
        ]);
    }

    public function down()
    {
        $this->dropTable('authors');
    }
}
