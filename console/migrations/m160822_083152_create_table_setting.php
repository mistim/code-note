<?php

use yii\db\Migration;

/**
 * Handles the creation for table `setting`.
 */
class m160822_083152_create_table_setting extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('{{%setting}}', [
            'id'         => $this->primaryKey(),
            'status'     => $this->boolean()->notNull(), // == tinyint(1)
            'var_key'    => $this->string()->notNull(),
            'value'      => $this->string()->notNull(),
            'created_at' => $this->timestamp()->notNull(),
            'updated_at' => $this->timestamp(),
            'creator_id' => $this->integer()->notNull(),
            'editor_id'  => $this->integer()->null(),
        ]);

        $this->addForeignKey('fk_setting_creator_id', '{{%setting}}', ['creator_id'], '{{%admin}}', ['id'], 'CASCADE', 'CASCADE');
        $this->addForeignKey('fk_setting_editor_id', '{{%setting}}', ['editor_id'], '{{%admin}}', ['id'], 'CASCADE', 'CASCADE');
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('{{%setting}}');
    }
}
