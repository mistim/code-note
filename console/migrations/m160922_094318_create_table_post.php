<?php

use yii\db\Migration;

class m160922_094318_create_table_post extends Migration
{
    public function up()
    {
        $this->createTable('{{%post}}', [
            'id'          => $this->primaryKey(),
            'title'       => $this->string()->notNull(),
            'alias'       => $this->string()->notNull(),
            'teaser'      => $this->string(1000)->null(),
            'text'        => $this->text()->notNull(),
            'image'       => $this->string()->null(),
            'status'      => $this->boolean()->notNull(),
            'posted_at'   => $this->dateTime()->null(),
            'category_id' => $this->integer()->notNull(),
            'creator_id'  => $this->integer(),
            'editor_id'   => $this->integer(),
            'created_at'  => $this->dateTime()->notNull(),
            'updated_at'  => $this->dateTime()->null(),
            'meta_tag'    => $this->integer()->null(),
        ]);

        $this->addForeignKey('fk_post_to_categoryID', '{{%post}}', ['category_id'], '{{%category}}', ['id'], 'RESTRICT', 'RESTRICT');
        $this->addForeignKey('fk_post_to_creatorID', '{{%post}}', ['creator_id'], '{{%admin}}', ['id'], 'RESTRICT', 'RESTRICT');
        $this->addForeignKey('fk_post_to_editorID', '{{%post}}', ['editor_id'], '{{%admin}}', ['id'], 'RESTRICT', 'RESTRICT');
        $this->addForeignKey('fk_post_to_meta_tagID', '{{%post}}', ['meta_tag_id'], '{{%meta_tag}}', ['id'], 'RESTRICT', 'RESTRICT');
    }

    public function down()
    {
        $this->dropTable('{{%post}}');
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
