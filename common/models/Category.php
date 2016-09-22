<?php

namespace common\models;

use backend\models\User;
use Yii;

/**
 * This is the model class for table "category".
 *
 * @property integer $id
 * @property string $title
 * @property string $alias
 * @property string $teaser
 * @property integer $status
 * @property integer $creator_id
 * @property integer $editor_id
 * @property string $created_at
 * @property string $updated_at
 *
 * @property User $creator
 * @property User $editor
 * @property Note[] $notes
 * @property Post[] $posts
 */
class Category extends \yii\db\ActiveRecord
{
    const STATUS_IN_ACTIVE = 0;
    const STATUS_ACTIVE    = 1;

    const CACHE_KEY      = 'modelCategory_';
    const CACHE_DURATION = 0;

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
            [['title', 'status', 'alias'], 'required'],
            [['status', 'creator_id', 'editor_id'], 'integer'],
            [['created_at', 'updated_at'], 'safe'],
            [['title', 'alias', 'teaser'], 'string', 'max' => 255],
            [
                ['creator_id'], 'exist', 'skipOnError'     => true, 'targetClass' => Admin::className(),
                                         'targetAttribute' => ['creator_id' => 'id'],
            ],
            [
                ['editor_id'], 'exist', 'skipOnError'     => true, 'targetClass' => Admin::className(),
                                        'targetAttribute' => ['editor_id' => 'id'],
            ],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id'         => Yii::t('admin', 'ID'),
            'title'      => Yii::t('admin', 'Title'),
            'alias'      => Yii::t('admin', 'Alias'),
            'teaser'     => Yii::t('admin', 'Teaser'),
            'status'     => Yii::t('admin', 'Status'),
            'creator_id' => Yii::t('admin', 'Creator'),
            'editor_id'  => Yii::t('admin', 'Editor'),
            'created_at' => Yii::t('admin', 'Date created'),
            'updated_at' => Yii::t('admin', 'Date updated'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCreator()
    {
        return $this->hasOne(User::className(), ['id' => 'creator_id'])
            ->from(['creator' => User::tableName()]);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getEditor()
    {
        return $this->hasOne(User::className(), ['id' => 'editor_id'])
            ->from(['editor' => User::tableName()]);
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

    /**
     * @param bool $insert
     * @return bool
     */
    public function beforeSave($insert)
    {
        if (parent::beforeSave($insert)) {
            if ($this->isNewRecord) {
                $this->created_at = (new \DateTime())->format('Y-m-d H:i:s');
                $this->creator_id = Yii::$app->user->getId();
            } else {
                $this->updated_at = (new \DateTime())->format('Y-m-d H:i:s');
                $this->editor_id = Yii::$app->user->getId();
            }

            return true;
        } else {
            return false;
        }
    }

    /**
     * @param bool $insert
     * @param array $changedAttributes
     * @throws \Exception
     */
    public function afterSave($insert, $changedAttributes)
    {
        parent::afterSave($insert, $changedAttributes);

        $this->clearCacheModel('all');
        $this->clearCacheModel($this->alias);
    }

    /**
     * @return mixed|static[]
     */
    public static function getAllActive()
    {
        $keyCache = self::CACHE_KEY . 'all';
        $data = Yii::$app->cacheFrontend->get($keyCache);

        if (!$data) {
            $model = self::findAll(['status' => self::STATUS_ACTIVE]);

            /** @var Category $item */
            foreach ($model as $item) {
                $data[$item->getPrimaryKey()] = $item;
            }

            Yii::$app->cacheFrontend->set($keyCache, $data, self::CACHE_DURATION);
        }

        return $data;
    }

    /**
     * @param string|integer $subKey
     * @return bool
     *
     * delete all: $subKey = "all"
     * delete default: $subKey = "default"
     * delete one: $subKey = $model->getPrimaryKey
     */
    public static function clearCacheModel($subKey)
    {
        $keyCache = self::CACHE_KEY . $subKey;

        return Yii::$app->cacheFrontend->delete($keyCache);
    }
}
