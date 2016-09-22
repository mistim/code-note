<?php

use yii\db\Migration;

class m160823_120725_insert_rbac_data extends Migration
{
    public function up()
    {
        $this->execute(require_once('insert_rbac_data.php'));
    }

    public function down()
    {
        echo "m160823_120725_insert_rbac_data cannot be reverted.\n";

        return false;
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
