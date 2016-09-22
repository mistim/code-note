<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "note".
 *
 * @property integer $id
 * @property string $title
 * @property string $teaser
 * @property string $content
 * @property integer $status
 * @property string $posted_at
 * @property integer $category_id
 * @property integer $creator_id
 * @property integer $editor_id
 * @property string $created_at
 * @property string $updated_at
 *
 * @property Category $category
 * @property Admin $creator
 * @property Admin $editor
 * @property NoteTag[] $noteTags
 */
class Note extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'note';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['title', 'content', 'status', 'category_id', 'created_at'], 'required'],
            [['content'], 'string'],
            [['status', 'category_id', 'creator_id', 'editor_id'], 'integer'],
            [['posted_at', 'created_at', 'updated_at'], 'safe'],
            [['title', 'teaser'], 'string', 'max' => 255],
            [['category_id'], 'exist', 'skipOnError' => true, 'targetClass' => Category::className(), 'targetAttribute' => ['category_id' => 'id']],
            [['creator_id'], 'exist', 'skipOnError' => true, 'targetClass' => Admin::className(), 'targetAttribute' => ['creator_id' => 'id']],
            [['editor_id'], 'exist', 'skipOnError' => true, 'targetClass' => Admin::className(), 'targetAttribute' => ['editor_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('admin', 'ID'),
            'title' => Yii::t('admin', 'Title'),
            'teaser' => Yii::t('admin', 'Teaser'),
            'content' => Yii::t('admin', 'Content'),
            'status' => Yii::t('admin', 'Status'),
            'posted_at' => Yii::t('admin', 'Posted At'),
            'category_id' => Yii::t('admin', 'Category ID'),
            'creator_id' => Yii::t('admin', 'Creator ID'),
            'editor_id' => Yii::t('admin', 'Editor ID'),
            'created_at' => Yii::t('admin', 'Created At'),
            'updated_at' => Yii::t('admin', 'Updated At'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCategory()
    {
        return $this->hasOne(Category::className(), ['id' => 'category_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCreator()
    {
        return $this->hasOne(Admin::className(), ['id' => 'creator_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getEditor()
    {
        return $this->hasOne(Admin::className(), ['id' => 'editor_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getNoteTags()
    {
        return $this->hasMany(NoteTag::className(), ['note_id' => 'id']);
    }
}
