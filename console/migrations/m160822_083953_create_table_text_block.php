<?php

use yii\db\Migration;

/**
 * Handles the creation for table `text_block`.
 */
class m160822_083953_create_table_text_block extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('{{%text_block}}', [
            'id'         => $this->primaryKey(),
            'alias'      => $this->string()->notNull(),
            'status'     => $this->boolean()->notNull(), // == tinyint(1)
            'title'      => $this->string()->notNull(),
            'text'       => $this->text()->notNull(),
            'image'      => $this->string(),
            'creator_id' => $this->integer()->notNull(),
            'editor_id'  => $this->integer(),
            'created_at' => $this->dateTime()->notNull(),
            'updated_at' => $this->dateTime()->null(),
        ]);

        $this->addForeignKey('fk_text_block_to_creatorID', '{{%text_block}}', ['creator_id'], '{{%admin}}', ['id'], 'CASCADE', 'CASCADE');
        $this->addForeignKey('fk_text_block_to_editorID', '{{%text_block}}', ['editor_id'], '{{%admin}}', ['id'], 'CASCADE', 'CASCADE');
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('{{%text_block}}');
    }
}
