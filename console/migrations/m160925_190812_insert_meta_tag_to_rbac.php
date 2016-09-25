<?php

use yii\db\Migration;

class m160925_190812_insert_meta_tag_to_rbac extends Migration
{
    public function up()
    {
        $this->execute("
            SET FOREIGN_KEY_CHECKS=0;

            -- ----------------------------
            -- Records of auth_item
            -- ----------------------------
            INSERT INTO `auth_item` VALUES ('/meta-tag/*', '2', null, null, null, '1474551617', '1474551617');
            INSERT INTO `auth_item` VALUES ('/meta-tag/create', '2', null, null, null, '1474551617', '1474551617');
            INSERT INTO `auth_item` VALUES ('/meta-tag/delete', '2', null, null, null, '1474551617', '1474551617');
            INSERT INTO `auth_item` VALUES ('/meta-tag/index', '2', null, null, null, '1474551617', '1474551617');
            INSERT INTO `auth_item` VALUES ('/meta-tag/update', '2', null, null, null, '1474551617', '1474551617');
            INSERT INTO `auth_item` VALUES ('/meta-tag/view', '2', null, null, null, '1474551617', '1474551617');

            -- ----------------------------
            -- Records of auth_item_child
            -- ----------------------------
            INSERT INTO `auth_item_child` VALUES ('Admin area full', '/meta-tag/*');
            INSERT INTO `auth_item_child` VALUES ('Admin area full', '/meta-tag/create');
            INSERT INTO `auth_item_child` VALUES ('Admin area full', '/meta-tag/delete');
            INSERT INTO `auth_item_child` VALUES ('Admin area full', '/meta-tag/index');
            INSERT INTO `auth_item_child` VALUES ('Admin area full', '/meta-tag/update');
            INSERT INTO `auth_item_child` VALUES ('Admin area full', '/meta-tag/view');
        ");
    }

    public function down()
    {
        echo "m160925_190812_insert_meta_tag_to_rbac cannot be reverted.\n";

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
