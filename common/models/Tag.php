<?php

namespace common\models;

use Yii;
use yii\caching\TagDependency;

/**
 * This is the model class for table "tag".
 *
 * @property integer   $id
 * @property string    $title
 * @property string    $alias
 * @property integer   $status
 * @property integer   $meta_tag_id
 *
 * @property NoteTag[] $noteTags
 * @property PostTag[] $postTags
 * @property Post[]    $posts
 * @property Note[]    $notes
 * @property MetaTag   $meta_tag
 */
class Tag extends \yii\db\ActiveRecord
{

	const STATUS_IN_ACTIVE = 0;
	const STATUS_ACTIVE    = 1;

	const CACHE_KEY      = 'modelTag_';
	const CACHE_DURATION = 0;

	/**
	 * @inheritdoc
	 */
	public static function tableName()
	{
		return 'tag';
	}

	/**
	 * @inheritdoc
	 */
	public function rules()
	{
		return [
			[['title', 'alias', 'status'], 'required'],
			//['alias', 'unique'],
			[['status'], 'integer'],
			[['title', 'alias'], 'string', 'max' => 255],
		];
	}

	/**
	 * @inheritdoc
	 */
	public function attributeLabels()
	{
		return [
			'id'     => Yii::t('admin', 'ID'),
			'title'  => Yii::t('admin', 'Title'),
			'alias'  => Yii::t('admin', 'Alias'),
			'status' => Yii::t('admin', 'Status'),
		];
	}

	/**
	 * @return \yii\db\ActiveQuery
	 */
	public function getMeta_tag()
	{
		return $this->hasOne(MetaTag::className(), ['id' => 'meta_tag_id']);
	}

	/**
	 * @return \yii\db\ActiveQuery
	 */
	public function getNoteTags()
	{
		return $this->hasMany(PostTag::className(), ['tag_id' => 'id']);
	}

	/**
	 * @return \yii\db\ActiveQuery
	 */
	public function getNotes()
	{
		return $this->hasMany(Note::className(), ['id' => 'post_id'])
			->where(['is_post' => Note::IS_POST])
			->via('postTags');
	}

	/**
	 * @return \yii\db\ActiveQuery
	 */
	public function getPostTags()
	{
		return $this->hasMany(PostTag::className(), ['tag_id' => 'id']);
	}

	/**
	 * @return \yii\db\ActiveQuery
	 */
	public function getPosts()
	{
		return $this->hasMany(Post::className(), ['id' => 'post_id'])
			->where(['is_post' => Post::IS_POST])
			->via('postTags');
	}

    /**
     * @param null $cache_prefix
     * @param bool $use_cache
     * @return null
     */
    public function countNotes($cache_prefix = null, $use_cache = true)
    {
        $data = null;
        $keyCache = self::CACHE_KEY . 'countNotes' . $cache_prefix;
        $use_cache && $data = Yii::$app->cacheFrontend->get($keyCache);

        if ($data === null) {
            Yii::$app->cacheFrontend->set(
                $keyCache,
                $this->getNotes()->count(),
                self::CACHE_DURATION,
                new TagDependency(['tags' => self::CACHE_KEY])
            );
        }

        return $data;
    }

    /**
     * @param null $cache_prefix
     * @param bool $use_cache
     * @return null
     */
    public function countPosts($cache_prefix = null, $use_cache = true)
    {
        $data = null;
        $keyCache = self::CACHE_KEY . 'countPosts' . $cache_prefix;
        $use_cache && $data = Yii::$app->cacheFrontend->get($keyCache);

        if ($data === null) {
            Yii::$app->cacheFrontend->set(
                $keyCache,
                $this->getPosts()->count(),
                self::CACHE_DURATION,
                new TagDependency(['tags' => self::CACHE_KEY])
            );
        }

        return $data;
    }

	/**
	 * @param bool $insert
	 *
	 * @return bool
	 */
	public function beforeSave($insert)
	{
		if (parent::beforeSave($insert)) {


			return true;
		} else {
			return false;
		}
	}

	/**
	 * @param bool  $insert
	 * @param array $changedAttributes
	 *
	 * @throws \Exception
	 */
	public function afterSave($insert, $changedAttributes)
	{
		parent::afterSave($insert, $changedAttributes);

		$this->clearCacheModel();
	}

	/**
	 * @param bool|false $use_cache
	 *
	 * @return array|null|Post[]
	 */
	public static function getAllActive($use_cache = false)
	{
		$data = null;
		$keyCache = self::CACHE_KEY . 'all';
		$use_cache && $data = Yii::$app->cacheFrontend->get($keyCache);

		if (!$data) {
			$model = self::findAll(['status' => self::STATUS_ACTIVE]);

			if ($model && $use_cache) {
				/** @var Category $item */
				foreach ($model as $item) {
					$data[$item->getPrimaryKey()] = $item;
				}

				Yii::$app->cacheFrontend->set(
					$keyCache, $data, self::CACHE_DURATION,
					new TagDependency(['tags' => self::CACHE_KEY])
				);
			} else {
				$data = $model;
			}
		}

		return $data ? $data : [];
	}

	/**
	 * @param           $alias
	 * @param bool|true $use_cache
	 *
	 * @return null|Tag
	 */
	public static function getActiveByAlias($alias, $use_cache = false)
	{
		$data = null;
		$keyCache = self::CACHE_KEY . $alias;
		$use_cache && $data = Yii::$app->cacheFrontend->get($keyCache);

		if (!$data) {
			$data = self::findOne([
				'status' => self::STATUS_ACTIVE,
				'alias'  => $alias,
			]);

			$use_cache && Yii::$app->cacheFrontend->set(
                $keyCache, $data, self::CACHE_DURATION,
                new TagDependency(['tags' => self::CACHE_KEY])
            );;
		}

		return $data;
	}

	/**
	 * @param null|string|integer $subKey
	 *
	 * delete all: $subKey = "all"
	 * delete default: $subKey = "default"
	 * delete one: $subKey = $model->getPrimaryKey
	 */
	public static function clearCacheModel($subKey = null)
	{
		if ($subKey) {
			$keyCache = self::CACHE_KEY . $subKey;

			Yii::$app->cacheFrontend->delete($keyCache);
		} else {
			TagDependency::invalidate(Yii::$app->cacheFrontend, self::CACHE_KEY);
		}
	}
}
