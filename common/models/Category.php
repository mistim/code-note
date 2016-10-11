<?php

namespace common\models;

use backend\models\User;
use Yii;
use yii\caching\TagDependency;

/**
 * This is the model class for table "category".
 *
 * @property integer $id
 * @property string  $title
 * @property string  $alias
 * @property string  $teaser
 * @property integer $status
 * @property integer $creator_id
 * @property integer $editor_id
 * @property string  $created_at
 * @property string  $updated_at
 * @property integer $meta_tag_id
 *
 * @property User    $creator
 * @property User    $editor
 * @property Note[]  $notes
 * @property Post[]  $posts
 * @property MetaTag $meta_tag
 */
class Category extends \yii\db\ActiveRecord
{
	const STATUS_IN_ACTIVE = 0;
	const STATUS_ACTIVE    = 1;

	const CACHE_KEY      = 'modelCategory_';
	const CACHE_DURATION = 0;

	public $cnt_all;
	public $cnt_post;
	public $cnt_note;

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
			[['title', 'alias'], 'string', 'max' => 255],
			['teaser', 'string', 'max' => 1000],
			[
				['creator_id'], 'exist', 'skipOnError'     => true,
				                         'targetClass'     => Admin::className(),
				                         'targetAttribute' => ['creator_id' => 'id'],
			],
			[
				['editor_id'], 'exist', 'skipOnError'     => true,
				                        'targetClass'     => Admin::className(),
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
	public function getMeta_tag()
	{
		return $this->hasOne(MetaTag::className(), ['id' => 'meta_tag_id']);
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
		return $this->hasMany(Note::className(), ['category_id' => 'id'])
			->where(['is_post' => Note::IS_POST]);
	}

	/**
	 * @return \yii\db\ActiveQuery
	 */
	public function getPosts()
	{
		return $this->hasMany(Post::className(), ['category_id' => 'id'])
			->where(['is_post' => Post::IS_POST]);
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
	 * @param MetaTag $meta_tag
	 *
	 * @return bool
	 * @throws \Exception
	 * @throws \yii\db\Exception
	 */
	public function saveWithMetaKay(MetaTag $meta_tag)
	{
		$transaction = self::getDb()->beginTransaction();

		try {
			self::save();

			if ($this->isNewRecord || !$meta_tag) {
				$meta_tag = new MetaTag();
			}

			$meta_tag->entity = self::className();
			$meta_tag->save();

			$this->meta_tag_id = $meta_tag->getPrimaryKey();
			self::update();

			$transaction->commit();

			return true;
		} catch (\Exception $e) {
			$transaction->rollBack();
			throw $e;
		}
	}

	/**
	 * @param bool $insert
	 *
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
				$this->editor_id  = Yii::$app->user->getId();
			}

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
     * @param bool $use_cache
     * @return array|null|static[]
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
     * @param $alias
     * @param bool $use_cache
     * @return null|static
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
            );
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

	/**
	 * @return mixed
	 */
	public static function getActiveWithCnt()
	{
		$keyCache = self::CACHE_KEY . 'all';
		$data     = Yii::$app->cacheFrontend->get($keyCache);

		if (!$data) {
			$model = self::find()
				->select([
					'category.id', 'category.title', 'category.alias',
					'COUNT(post.id) AS cnt_post', 'COUNT(note.id) AS cnt_note',
				])
				->leftJoin('post', '`post`.`category_id` = `category`.`id`')
				->leftJoin('note', '`note`.`category_id` = `category`.`id`')
				->where([
					'category.status' => self::STATUS_ACTIVE,
					'post.status'     => self::STATUS_ACTIVE,
					'note.status'     => self::STATUS_ACTIVE,
				])
				->all();

			/** @var Category $item */
			foreach ($model as $item) {
				$data[$item->getPrimaryKey()] = $item;
			}

			Yii::$app->cacheFrontend->set(
				$keyCache, $data, self::CACHE_DURATION,
				new TagDependency(['tags' => self::CACHE_KEY])
			);
		}

		return $data;

	}

	public static function getActiveWithCntPost()
	{

	}

	public static function getActiveWithCntNote()
	{

	}
}
