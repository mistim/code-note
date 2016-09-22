<?php

use yii\db\Migration;

class m160922_134201_insert_category_to_rbac extends Migration
{
    public function up()
    {
        $this->execute("
            SET FOREIGN_KEY_CHECKS=0;

            -- ----------------------------
            -- Records of auth_item
            -- ----------------------------
            INSERT INTO `auth_item` VALUES ('/category/*', '2', null, null, null, '1474551617', '1474551617');
            INSERT INTO `auth_item` VALUES ('/category/create', '2', null, null, null, '1474551617', '1474551617');
            INSERT INTO `auth_item` VALUES ('/category/delete', '2', null, null, null, '1474551617', '1474551617');
            INSERT INTO `auth_item` VALUES ('/category/index', '2', null, null, null, '1474551617', '1474551617');
            INSERT INTO `auth_item` VALUES ('/category/update', '2', null, null, null, '1474551617', '1474551617');
            INSERT INTO `auth_item` VALUES ('/category/view', '2', null, null, null, '1474551617', '1474551617');

            -- ----------------------------
            -- Records of auth_item_child
            -- ----------------------------
            INSERT INTO `auth_item_child` VALUES ('Admin area full', '/category/*');
            INSERT INTO `auth_item_child` VALUES ('Admin area full', '/category/create');
            INSERT INTO `auth_item_child` VALUES ('Admin area full', '/category/delete');
            INSERT INTO `auth_item_child` VALUES ('Admin area full', '/category/index');
            INSERT INTO `auth_item_child` VALUES ('Admin area full', '/category/update');
            INSERT INTO `auth_item_child` VALUES ('Admin area full', '/category/view');
        ");
    }

    public function down()
    {
        echo "m160922_134201_insert_category_to_rbac cannot be reverted.\n";

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
