<?php

use yii\db\Migration;

class m160926_185235_create_view_post_note extends Migration
{
    public function up()
    {
        $this->execute("
            CREATE
            OR REPLACE VIEW post_note AS SELECT
                `post`.`id` AS `id`,
                `post`.`title` AS `title`,
                `post`.`alias` AS `alias`,
                `post`.`teaser` AS `teaser`,
                `post`.`text` AS `text`,
                `post`.`image` AS `image`,
                `post`.`status` AS `status`,
                `post`.`posted_at` AS `posted_at`,
                `post`.`category_id` AS `category_id`,
                `post`.`creator_id` AS `creator_id`,
                `post`.`editor_id` AS `editor_id`,
                `post`.`created_at` AS `created_at`,
                `post`.`updated_at` AS `updated_at`,
                `post`.`meta_tag_id` AS `meta_tag_id`,
                1 AS `is_post`
            FROM
                post
            UNION
                SELECT
                    `note`.`id` AS `id`,
                    `note`.`title` AS `title`,
                    `note`.`alias` AS `alias`,
                    `note`.`teaser` AS `teaser`,
                    `note`.`text` AS `text`,
                    '' AS `image`,
                    `note`.`status` AS `status`,
                    `note`.`posted_at` AS `posted_at`,
                    `note`.`category_id` AS `category_id`,
                    `note`.`creator_id` AS `creator_id`,
                    `note`.`editor_id` AS `editor_id`,
                    `note`.`created_at` AS `created_at`,
                    `note`.`updated_at` AS `updated_at`,
                    `note`.`meta_tag_id` AS `meta_tag_id`,
                    0 AS `is_post`
                FROM
                    note;
        ");
    }

    public function down()
    {
        $this->execute("DROP VIEW post_note");
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
