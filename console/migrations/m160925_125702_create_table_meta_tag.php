<?php

use yii\db\Migration;

class m160925_125702_create_table_meta_tag extends Migration
{
    public function up()
    {
        $this->createTable('{{%meta_tag}}', [
            'id'          => $this->primaryKey(),
            'entity'      => $this->string()->notNull(),
            'status'      => $this->boolean()->notNull(),
            'title'       => $this->string()->notNull(),
            'key'         => $this->string()->notNull(),
            'description' => $this->string()->notNull(),
        ]);
    }

    public function down()
    {
        $this->dropTable('{{%meta_tag}}');
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
