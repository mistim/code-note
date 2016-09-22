<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "category".
 *
 * @property integer $id
 * @property string $title
 * @property string $teaser
 * @property integer $status
 * @property integer $creator_id
 * @property integer $editor_id
 * @property string $created_at
 * @property string $updated_at
 *
 * @property Admin $creator
 * @property Admin $editor
 * @property Note[] $notes
 * @property Post[] $posts
 */
class Category extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'category';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['title', 'status', 'created_at'], 'required'],
            [['status', 'creator_id', 'editor_id'], 'integer'],
            [['created_at', 'updated_at'], 'safe'],
            [['title', 'teaser'], 'string', 'max' => 255],
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
            'status' => Yii::t('admin', 'Status'),
            'creator_id' => Yii::t('admin', 'Creator ID'),
            'editor_id' => Yii::t('admin', 'Editor ID'),
            'created_at' => Yii::t('admin', 'Created At'),
            'updated_at' => Yii::t('admin', 'Updated At'),
        ];
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
    public function getNotes()
    {
        return $this->hasMany(Note::className(), ['category_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPosts()
    {
        return $this->hasMany(Post::className(), ['category_id' => 'id']);
    }
}
