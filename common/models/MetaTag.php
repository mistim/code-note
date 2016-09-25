<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "meta_tag".
 *
 * @property integer  $id
 * @property string   $entity
 * @property integer  $status
 * @property string   $title
 * @property string   $key
 * @property string   $description
 *
 * @property Category $category
 * @property Post     $post
 * @property Note     $note
 */
class MetaTag extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'meta_tag';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['entity', 'status'], 'required'],
            [['status'], 'integer'],
            [['entity', 'title', 'key', 'description'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id'          => Yii::t('admin', 'ID'),
            'entity'      => Yii::t('admin', 'Entity'),
            'status'      => Yii::t('admin', 'Status'),
            'title'       => Yii::t('admin', 'Title'),
            'key'         => Yii::t('admin', 'Key'),
            'description' => Yii::t('admin', 'Description'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCategory()
    {
        return $this->hasOne(Category::className(), ['meta_tag_id' => 'id'])
            ->where('entity = :entity', [':entity' => Category::className()]);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPost()
    {
        return $this->hasOne(Post::className(), ['meta_tag_id' => 'id'])
            ->where('entity = :entity', [':entity' => Post::className()]);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getNote()
    {
        return $this->hasOne(Note::className(), ['meta_tag_id' => 'id'])
            ->where('entity = :entity', [':entity' => Note::className()]);
    }
}
