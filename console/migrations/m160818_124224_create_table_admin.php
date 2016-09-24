<?php

use yii\db\Migration;

/**
 * Handles the creation for table `admin`.
 */
class m160818_124224_create_table_admin extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $tableOptions = null;

        // MySql table options
        if ($this->db->driverName === 'mysql') {
            // http://stackoverflow.com/questions/766809/whats-the-difference-between-utf8-general-ci-and-utf8-unicode-ci
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        // Admin table
        $this->createTable(
            '{{%admin}}', [
                'id'                   => $this->primaryKey(),
                'username'             => $this->string()->notNull()->unique(),
                'auth_key'             => $this->string(32)->notNull(),
                'password_hash'        => $this->string()->notNull(),
                'password_reset_token' => $this->string()->unique(),
                'email'                => $this->string()->notNull()->unique(),

                'status'               => $this->smallInteger()->notNull()->defaultValue(10),
                'created_at'           => $this->integer()->notNull(),
                'updated_at'           => $this->integer()->null(),
                'last_enter'           => $this->integer()->null(),
            ],
            $tableOptions
        );

        // Indexes
        $this->createIndex('ind_admin_username', '{{%admin}}', 'username', true);
        $this->createIndex('ind_admin_email', '{{%admin}}', 'email', true);
        $this->createIndex('ind_admin_status', '{{%admin}}', 'status');
        $this->createIndex('ind_admin_created_at', '{{%admin}}', 'created_at');

        // Add super-administrator
        $this->execute($this->getUserSql());
    }

    /**
     * @return string SQL to insert first user
     */
    private function getUserSql()
    {
        $time = time();
        $password_hash = Yii::$app->security->generatePasswordHash('123');
        $auth_key = Yii::$app->security->generateRandomString();
        $token = Yii::$app->security->generateRandomString();
        return "INSERT INTO {{%admin}} (username, email, password_hash, auth_key, password_reset_token, status, created_at, updated_at, last_enter) VALUES ('admin', 'admin@local.loc', '$password_hash', '$auth_key', '$token', 1, $time, $time, null)";
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('{{%admin}}');
    }
}
