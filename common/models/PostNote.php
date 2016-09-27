<?php

namespace common\models;

use backend\components\TagBehavior;
use backend\widgets\fileapi\behaviors\UploadBehavior;
use Yii;
use backend\models\User;
use yii\caching\TagDependency;

/**
 * This is the model class for view "post_note".
 *
 * @property integer   $id
 * @property string    $title
 * @property string    $alias
 * @property string    $teaser
 * @property string    $text
 * @property string    $image
 * @property integer   $status
 * @property string    $posted_at
 * @property integer   $category_id
 * @property integer   $creator_id
 * @property integer   $editor_id
 * @property string    $created_at
 * @property string    $updated_at
 * @property integer   $meta_tag_id
 * @property integer   $is_post
 *
 * @property User      $editor
 * @property User      $creator
 * @property Category  $category
 * @property MetaTag   $meta_tag
 * @property Tag[]     $tags
 * @property PostTag[] $postTags
 * @property NoteTag[] $nateTags
 */
class PostNote extends \yii\db\ActiveRecord
{

	const STATUS_IN_ACTIVE = 0;
	const STATUS_ACTIVE    = 1;

	const CACHE_KEY      = 'viewPostNote_';
	const CACHE_DURATION = 0;

	const IMAGE_PATH = '@statics/web/uploads/post';
	const IMAGE_TMP  = '@statics/web/uploads/post/temp';
	const IMAGE_URL  = '@statics_url/uploads/post';


	/**
	 * @return array
	 */
	public function behaviors()
	{
		return [
			'uploadBehavior' => [
				'class'      => UploadBehavior::className(),
				'attributes' => [
					'image' => [
						'path'     => self::IMAGE_PATH,
						'tempPath' => self::IMAGE_TMP,
						'url'      => Yii::getAlias(self::IMAGE_URL),
					],
				],
			],
			TagBehavior::className()
		];
	}

	/**
	 * @inheritdoc
	 */
	public static function tableName()
	{
		return 'post_note';
	}

	/**
	 * @inheritdoc
	 */
	public function rules()
	{
		return [
			[['title', 'alias', 'text', 'status', 'category_id'], 'required'],
			[['text'], 'string'],
			[['status', 'category_id', 'creator_id', 'editor_id', 'is_post'], 'integer'],
			[['posted_at', 'created_at', 'updated_at', 'list_tag'], 'safe'],
			[['title', 'alias', 'image'], 'string', 'max' => 255],
			['teaser', 'string', 'max' => 1000],
			['alias', 'unique'],
			[
				['editor_id'], 'exist', 'skipOnError'     => true,
				                        'targetClass'     => Admin::className(),
				                        'targetAttribute' => ['editor_id' => 'id'],
			],
			[
				['category_id'], 'exist', 'skipOnError'     => true,
				                          'targetClass'     => Category::className(),
				                          'targetAttribute' => ['category_id' => 'id'],
			],
			[
				['creator_id'], 'exist', 'skipOnError'     => true,
				                         'targetClass'     => Admin::className(),
				                         'targetAttribute' => ['creator_id' => 'id'],
			],
			[
				['image'], 'file', 'skipOnEmpty'            => true,
				                   'extensions'             => ['png', 'jpg', 'gif', 'bmp', 'jpeg'],
				                   'maxSize'                => 1024 * 1024 * 2,
				                   'enableClientValidation' => false,
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
			'image'       => Yii::t('admin', 'Image'),
			'status'      => Yii::t('admin', 'Status'),
			'posted_at'   => Yii::t('admin', 'Date posted'),
			'category_id' => Yii::t('admin', 'Category'),
			'creator_id'  => Yii::t('admin', 'Creator'),
			'editor_id'   => Yii::t('admin', 'Editor'),
			'created_at'  => Yii::t('admin', 'Date created'),
			'updated_at'  => Yii::t('admin', 'Date updated'),
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
	public function getPostTags()
	{
		return $this->hasMany(PostTag::className(), ['post_id' => 'id']);
	}

	/**
	 * @return \yii\db\ActiveQuery
	 */
	public function getNoteTags()
	{
		return $this->hasMany(NoteTag::className(), ['note_id' => 'id']);
	}

	/**
	 * @return mixed|static[]
	 */
	public static function getAllActive()
	{
		$keyCache = self::CACHE_KEY . 'all';
		$data     = Yii::$app->cacheFrontend->get($keyCache);

		if (!$data) {
			$model = self::findAll(['status' => self::STATUS_ACTIVE]);

			if ($model) {
				/** @var Category $item */
				foreach ($model as $item) {
					$data[$item->getPrimaryKey()] = $item;
				}

				Yii::$app->cacheFrontend->set(
					$keyCache, $data, self::CACHE_DURATION,
					new TagDependency(['tags' => self::CACHE_KEY])
				);
			}
		}

		return $data ? $data : [];
	}

	/**
	 * @param $alias
	 *
	 * @return null|Post
	 */
	public static function getActiveByAlias($alias)
	{
		$keyCache = self::CACHE_KEY . $alias;
		$data     = Yii::$app->cacheFrontend->get($keyCache);

		if (!$data) {
			$data = self::findOne([
				'status' => self::STATUS_ACTIVE,
				'alias'  => $alias,
			]);

			Yii::$app->cacheFrontend->set($keyCache, $data, self::CACHE_DURATION);
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