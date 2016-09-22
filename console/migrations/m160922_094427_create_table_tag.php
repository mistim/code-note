<?php

use yii\db\Migration;

class m160922_094427_create_table_tag extends Migration
{
    public function up()
    {
        $this->createTable('{{%tag}}', [
            'id'     => $this->primaryKey(),
            'title'  => $this->string()->notNull(),
            'status' => $this->boolean()->notNull(),
        ]);
    }

    public function down()
    {
        $this->dropTable('{{%tag}}');
    }

    /*
    // Use safeUp/safeDown to run migration code within a transaction
    public function safeUp()
    {
    }

    public function safeDown()
    {
    }
    */
}
