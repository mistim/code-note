<?php

namespace common\models;

use backend\widgets\fileapi\behaviors\UploadBehavior;
use backend\models\User;
use Yii;
use yii\caching\TagDependency;

/**
 * This is the model class for table "text_block".
 *
 * @property string  $id
 * @property string  $alias
 * @property integer $status
 * @property integer $creator_id
 * @property integer $editor_id
 * @property string  $created_at
 * @property string  $updated_at
 * @property string  $title
 * @property string  $text
 * @property string  $image
 *
 * @property User    $editor
 * @property User    $creator
 */
class TextBlock extends \yii\db\ActiveRecord
{
	const STATUS_IN_ACTIVE = 0;
	const STATUS_ACTIVE    = 1;

	const BLOCK_NOTES_CODE = 1;
	const BLOCK_ID_GAS     = 2;
	const BLOCK_ID_OIL     = 3;

	const CACHE_KEY      = 'modelTextBlock_';
	const CACHE_DURATION = 0;

	const IMAGE_PATH = '@statics/web/uploads/text-block';
	const IMAGE_TMP  = '@statics/web/uploads/text-block/temp';
	const IMAGE_URL  = '@statics_url/uploads/text-block';

	const IMAGE_WIDTH_MIN  = 525;
	const IMAGE_HEIGHT_MIN = 315;

	const BANNER_WIDTH_MIN  = 1440;
	const BANNER_HEIGHT_MIN = 460;

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
		];
	}

	/**
	 * @inheritdoc
	 */
	public static function tableName()
	{
		return 'text_block';
	}

	/**
	 * @inheritdoc
	 */
	public function rules()
	{
		return [
			[['alias', 'title', 'text'], 'required'],
			[['status', 'creator_id', 'editor_id'], 'integer'],
			[['created_at', 'updated_at', 'text'], 'safe'],
			[['alias'], 'string', 'max' => 50],
			[['title'], 'string', 'max' => 255],

			// проверяет, что "image" - это изображение в формате PNG, JPG или JPEG, GIF, BMP
			// размер файла должен быть меньше 1MB
			[
				['image'], 'file', 'skipOnEmpty'            => true,
				                   'extensions'             => ['png', 'jpg', 'gif', 'bmp', 'jpeg'],
				                   'maxSize'                => 1024 * 1024,
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
			'id'         => Yii::t('admin', 'ID'),
			'alias'      => Yii::t('admin', 'Alias'),
			'status'     => Yii::t('admin', 'Status'),
			'creator_id' => Yii::t('admin', 'Creator'),
			'editor_id'  => Yii::t('admin', 'Editor'),
			'created_at' => Yii::t('admin', 'Date created'),
			'updated_at' => Yii::t('admin', 'Date updated'),
			'image'      => Yii::t('admin', 'Image'),
			'title'      => Yii::t('admin', 'Title'),
			'text'       => Yii::t('admin', 'Text'),
		];
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
	public function getCreator()
	{
		return $this->hasOne(User::className(), ['id' => 'creator_id'])
			->from(['creator' => User::tableName()]);
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

		$this->clearCacheModel('all');
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
	 * @return null|Post
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

			$use_cache && Yii::$app->cacheFrontend->set($keyCache, $data, self::CACHE_DURATION);
		}

		return $data;
	}

	/**
	 * @param           $id
	 * @param bool|true $use_cache
	 *
	 * @return null|Post
	 */
	public static function getActiveByID($id, $use_cache = false)
	{
		$data     = null;
		$keyCache = self::CACHE_KEY . $id;
		$use_cache && $data = Yii::$app->cacheFrontend->get($keyCache);

		if (!$data) {
			$data = self::findOne([
				'status' => self::STATUS_ACTIVE,
				'id'     => $id,
			]);

			$use_cache && Yii::$app->cacheFrontend->set($keyCache, $data, self::CACHE_DURATION);
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
