<?php

namespace common\models;

use Yii;
use yii\caching\TagDependency;

/**
 * This is the model class for table "meta_tag".
 *
 * @property integer  $id
 * @property string   $entity
 * @property integer  $status
 * @property string   $title
 * @property string   $keyword
 * @property string   $description
 *
 * @property Category $category
 * @property Post     $post
 * @property Note     $note
 */
class MetaTag extends \yii\db\ActiveRecord
{
	const STATUS_IN_ACTIVE = 0;
	const STATUS_ACTIVE    = 1;

	const CACHE_KEY      = 'modelMetaKey_';
	const CACHE_DURATION = 0;

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
			[['status'], 'required'],
			[['status'], 'integer'],
			['link', 'unique'],
			[['entity', 'title', 'keyword', 'description'], 'string', 'max' => 255],
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
			'keyword'     => Yii::t('admin', 'Key'),
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

    public function afterSave($insert, $changedAttributes)
    {
        parent::afterSave($insert, $changedAttributes);

        self::clearCacheModel();
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
	 * @param $link
	 *
	 * @return null|MetaTag
	 */
	public static function getActiveByLink($link)
	{
		$keyCache = self::CACHE_KEY . $link;
		$data     = Yii::$app->cacheFrontend->get($keyCache);

		if (!$data) {
			$data = self::findOne([
				'status' => self::STATUS_ACTIVE,
				'link'   => $link,
			]);

			Yii::$app->cacheFrontend->set(
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
}
