<?php

use yii\db\Migration;

class m160922_094339_create_table_note extends Migration
{
    public function up()
    {
        $this->createTable('{{%note}}', [
            'id'          => $this->primaryKey(),
            'title'       => $this->string()->notNull(),
            'alias'       => $this->string()->notNull(),
            'teaser'      => $this->string()->null(),
            'content'     => $this->text()->notNull(),
            'status'      => $this->boolean()->notNull(),
            'posted_at'   => $this->dateTime()->null(),
            'category_id' => $this->integer()->notNull(),
            'creator_id'  => $this->integer(),
            'editor_id'   => $this->integer(),
            'created_at'  => $this->dateTime()->notNull(),
            'updated_at'  => $this->dateTime()->null(),
        ]);

        $this->addForeignKey('fk_note_to_categoryID', '{{%note}}', ['category_id'], '{{%category}}', ['id'], 'RESTRICT', 'RESTRICT');
        $this->addForeignKey('fk_note_to_creatorID', '{{%note}}', ['creator_id'], '{{%admin}}', ['id'], 'RESTRICT', 'RESTRICT');
        $this->addForeignKey('fk_note_to_editorID', '{{%note}}', ['editor_id'], '{{%admin}}', ['id'], 'RESTRICT', 'RESTRICT');
    }

    public function down()
    {
        $this->dropTable('{{%note}}');
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
