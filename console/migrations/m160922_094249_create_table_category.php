<?php

use yii\db\Migration;

class m160922_094249_create_table_category extends Migration
{
    public function up()
    {
        $this->createTable('{{%category}}', [
            'id'          => $this->primaryKey(),
            'title'       => $this->string()->notNull(),
            'alias'       => $this->string()->notNull(),
            'teaser'      => $this->string()->null(),
            'status'      => $this->boolean()->notNull(),
            'creator_id'  => $this->integer(),
            'editor_id'   => $this->integer(),
            'created_at'  => $this->dateTime()->notNull(),
            'updated_at'  => $this->dateTime()->null(),
        ]);

        $this->addForeignKey('fk_category_to_creatorID', '{{%category}}', ['creator_id'], '{{%admin}}', ['id'], 'RESTRICT', 'RESTRICT');
        $this->addForeignKey('fk_category_to_editorID', '{{%category}}', ['editor_id'], '{{%admin}}', ['id'], 'RESTRICT', 'RESTRICT');
    }

    public function down()
    {
        $this->dropTable('{{%category}}');
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
