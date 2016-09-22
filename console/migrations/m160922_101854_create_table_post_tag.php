<?php

use yii\db\Migration;

class m160922_101854_create_table_post_tag extends Migration
{
    public function up()
    {
        $this->createTable('{{%post_tag}}', [
            'id'      => $this->primaryKey(),
            'post_id' => $this->integer()->notNull(),
            'tag_id'  => $this->integer()->notNull(),
        ]);

        $this->addForeignKey('fk_post_tag_to_postID', '{{%post_tag}}', ['post_id'], '{{%post}}', ['id'], 'RESTRICT', 'RESTRICT');
        $this->addForeignKey('fk_post_tag_to_tagID', '{{%post_tag}}', ['tag_id'], '{{%tag}}', ['id'], 'RESTRICT', 'RESTRICT');
    }

    public function down()
    {
        $this->dropTable('{{%post_tag}}');
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
