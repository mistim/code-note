<?php

use yii\db\Migration;

class m160922_101844_create_table_note_tag extends Migration
{
    public function up()
    {
        $this->createTable('{{%note_tag}}', [
            'id'      => $this->primaryKey(),
            'note_id' => $this->integer()->notNull(),
            'tag_id'  => $this->integer()->notNull(),
        ]);

        $this->addForeignKey('fk_note_tag_to_noteID', '{{%note_tag}}', ['note_id'], '{{%note}}', ['id'], 'RESTRICT', 'RESTRICT');
        $this->addForeignKey('fk_note_tag_to_tagID', '{{%note_tag}}', ['tag_id'], '{{%tag}}', ['id'], 'RESTRICT', 'RESTRICT');
    }

    public function down()
    {
        $this->dropTable('{{%note_tag}}');
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
