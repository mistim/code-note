<?php

namespace common\models;

use common\components\TagBehavior;
use frontend\modules\sitemap\behaviors\SitemapBehavior;
use Yii;
use backend\models\User;
use yii\caching\TagDependency;
use yii\data\ActiveDataProvider;
use yii\helpers\Url;

/**
 * This is the model class for table "note".
 *
 * @property integer   $id
 * @property string    $title
 * @property string    $alias
 * @property string    $teaser
 * @property string    $text
 * @property integer   $status
 * @property string    $posted_at
 * @property integer   $category_id
 * @property integer   $creator_id
 * @property integer   $editor_id
 * @property string    $created_at
 * @property string    $updated_at
 * @property integer   $meta_tag_id
 * @property integer   $is_post
 * @property integer   $cnt_view
 *
 * @property array     $list_tag
 *
 * @property User      $editor
 * @property Category  $category
 * @property User      $creator
 * @property MetaTag   $meta_tag
 * @property Tag[]     $tags
 *
 * @method void setListTagID(array $tags)
 */
class Note extends \yii\db\ActiveRecord
{
	const STATUS_IN_ACTIVE = 0;
	const STATUS_ACTIVE    = 1;

	const CACHE_KEY      = 'modelNote_';
	const CACHE_DURATION = 0;

	const IS_POST = 0;

    /**
     * @inheritdoc
     */
    public function init()
    {
        parent::init();

        $this->setDefaultValues();
    }

    /**
     * Set default values
     */
    protected function setDefaultValues()
    {
        $this->status = self::STATUS_ACTIVE;
    }

	public function behaviors()
	{
		return [
			TagBehavior::className(),
		];
	}

	/**
	 * @inheritdoc
	 */
	public static function tableName()
	{
		return 'post';
	}

	/**
	 * @inheritdoc
	 */
	public function rules()
	{
		return [
			[['title', 'alias', 'text', 'status', 'category_id'], 'required', 'on' => 'crud', 'except' => 'update'],
			['cnt_view', 'integer', 'on' => 'update', 'except' => 'crud'],
			[['text'], 'string'],
            [['status'], 'default', 'value'=> self::STATUS_ACTIVE],
			[['status', 'category_id', 'creator_id', 'editor_id', 'is_post'], 'integer'],
			[['posted_at', 'created_at', 'updated_at', 'list_tag'], 'safe'],
			[['title', 'alias'], 'string', 'max' => 255],
			['teaser', 'string', 'max' => 1000],
			['alias', 'unique', 'targetAttribute' => 'id'],
			[
				['editor_id'], 'exist', 'skipOnError'     => true, 'targetClass' => Admin::className(),
				                        'targetAttribute' => ['editor_id' => 'id'],
			],
			[
				['category_id'], 'exist', 'skipOnError'     => true, 'targetClass' => Category::className(),
				                          'targetAttribute' => ['category_id' => 'id'],
			],
			[
				['creator_id'], 'exist', 'skipOnError'     => true, 'targetClass' => Admin::className(),
				                         'targetAttribute' => ['creator_id' => 'id'],
			],
		];
	}

	/**
	 * @inheritdoc
	 */
	public function attributeLabels()
	{
		return [
			'id'          => Yii::t('admin', 'ID'),
			'title'       => Yii::t('admin', 'Title'),
			'alias'       => Yii::t('admin', 'Alias'),
			'teaser'      => Yii::t('admin', 'Teaser'),
			'text'        => Yii::t('admin', 'Content'),
			'status'      => Yii::t('admin', 'Status'),
			'posted_at'   => Yii::t('admin', 'Date posted'),
			'category_id' => Yii::t('admin', 'Category'),
			'creator_id'  => Yii::t('admin', 'Creator'),
			'editor_id'   => Yii::t('admin', 'Editor'),
			'created_at'  => Yii::t('admin', 'Date created'),
			'updated_at'  => Yii::t('admin', 'Date updated'),
			'is_post'     => Yii::t('admin', 'Type'),
			'cnt_view'    => Yii::t('admin', 'Count view'),
		];
	}

	/**
	 * @return \yii\db\ActiveQuery
	 */
	public function getTags()
	{
		return $this->hasMany(Tag::className(), ['id' => 'tag_id'])
			->viaTable('post_tag', ['post_id' => 'id']);
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
	public function getEditor()
	{
		return $this->hasOne(User::className(), ['id' => 'editor_id'])
			->from(['editor' => User::tableName()]);
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
		return $this->hasOne(User::className(), ['id' => 'creator_id'])
			->from(['creator' => User::tableName()]);
	}

	/**
	 * @return \yii\db\ActiveQuery
	 */
	public function getNoteTags()
	{
		return $this->hasMany(PostTag::className(), ['post_id' => 'id'])
			->from(['note_tag' => PostTag::tableName()]);
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

                if (!$this->posted_at) {
                    $this->posted_at = $this->created_at;
                }
			} else {
				$this->updated_at = (new \DateTime())->format('Y-m-d H:i:s');
				$this->editor_id  = Yii::$app->user->getId();
			}

			$this->is_post = self::IS_POST;

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

		if ($this->list_tag) {
			PostTag::deleteAll([
				'post_id' => $this->id,
			]);

			foreach ($this->list_tag as $key => $val) {
				$tag = Tag::findOne([
					'title' => $val
				]);

				if (!$tag) {
					$tag         = new Tag();
					$tag->title  = $val;
					$tag->alias  = $val;
					$tag->status = Tag::STATUS_ACTIVE;
					if (!$tag->save()) {
						var_dump($tag->getErrors());
						exit;
					}
				}

				$model          = new PostTag();
				$model->post_id = $this->id;
				$model->tag_id  = $tag->id;

				if (!$model->save()) {
					var_dump($model->getErrors());
					exit;
				}
			}
		}

		self::clearCacheModel();
        Category::clearCacheModel();
        Tag::clearCacheModel();
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
	 * @throws \Exception
	 */
	public function updateCnt()
	{
		$this->scenario = 'update';
		$this->cnt_view++;
		$this->update();
		self::clearCacheModel();
	}

	/**
	 * @param bool|false $use_cache
	 *
	 * @return array|null|Note[]
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
	 * @return null|Note
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
                'is_post' => self::IS_POST
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
     * @param bool $use_cache
     *
     * @return ActiveDataProvider
     */
	public static function getDataProvider($use_cache = false)
	{
        $dataProvider = new ActiveDataProvider([
			'query' => self::find()->where([
				'AND',
				['status' => self::STATUS_ACTIVE],
				['is_post' => self::IS_POST],
				/*[
					'OR',
					['>', 'posted_at', date('Y-m-d 00:00:00')],
					['posted_at' => date('Y-m-d 00:00:00')]
				]*/
			]),
			'pagination' => [
				'pageSize' => 5,
			],
			'sort' => [
				'defaultOrder' => [
					'posted_at' => SORT_DESC
				]
			]
		]);

        $use_cache && self::getDb()->cache(function ($db) use ($dataProvider) {
            $dataProvider->prepare();
        }, self::CACHE_DURATION, new TagDependency(['tags' => self::CACHE_KEY]));

        return $dataProvider;
	}

	/**
	 * @param bool|true $use_cache
	 *
	 * @return null|static
	 */
	public function getPrev($use_cache = false)
	{
		$data = null;
		$keyCache = self::CACHE_KEY . 'prev_' . $this->getPrimaryKey();
		$use_cache && $data = Yii::$app->cacheFrontend->get($keyCache);

		if (!$data) {
			$data = self::find()->select(['id', 'title', 'alias'])
				->where([
					'AND',
					['status' => self::STATUS_ACTIVE],
					['is_post' => self::IS_POST],
					['<', 'id', $this->getPrimaryKey()]
				])
				->orderBy(['id' => SORT_DESC])
				->one();

			$use_cache && Yii::$app->cacheFrontend->set(
                $keyCache, $data, self::CACHE_DURATION,
                new TagDependency(['tags' => self::CACHE_KEY])
            );
		}

		return $data;
	}

	/**
	 * @param bool|true $use_cache
	 *
	 * @return null|static
	 */
	public function getNext($use_cache = false)
	{
		$data = null;
		$keyCache = self::CACHE_KEY . 'next_' . $this->getPrimaryKey();
		$use_cache && $data = Yii::$app->cacheFrontend->get($keyCache);

		if (!$data) {
			$data = self::find()->select(['id', 'title', 'alias'])
				->where([
					'AND',
					['status' => self::STATUS_ACTIVE],
					['is_post' => self::IS_POST],
					['>', 'id', $this->getPrimaryKey()]
				])
				->orderBy(['id' => SORT_ASC])
				->one();

			$use_cache && Yii::$app->cacheFrontend->set(
                $keyCache, $data, self::CACHE_DURATION,
                new TagDependency(['tags' => self::CACHE_KEY])
            );
		}

		return $data;
	}
}
