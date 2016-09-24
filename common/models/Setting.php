<?php

namespace common\models;

use backend\models\User;
use Yii;

/**
 * This is the model class for table "setting".
 *
 * @property integer $id
 * @property integer $status
 * @property string  $var_key
 * @property string  $value
 * @property string  $created_at
 * @property string  $updated_at
 * @property integer $creator_id
 * @property integer $editor_id
 *
 * @property User    $editor
 * @property User    $creator
 */
class Setting extends \yii\db\ActiveRecord
{
	const STATUS_IN_ACTIVE = 0;
	const STATUS_ACTIVE    = 1;

	const CACHE_KEY      = 'modelSetting_';
	const CACHE_DURATION = 0;

	/**
	 * @inheritdoc
	 */
	public static function tableName()
	{
		return 'setting';
	}

	/**
	 * @inheritdoc
	 */
	public function rules()
	{
		return [
			[['status', 'var_key', 'value'], 'required'],
			[['status', 'creator_id', 'editor_id'], 'integer'],
			[['created_at', 'updated_at'], 'safe'],
			[['var_key', 'value'], 'string', 'max' => 255],
			[
				['editor_id'], 'exist', 'skipOnError'     => true, 'targetClass' => User::className(),
				                        'targetAttribute' => ['editor_id' => 'id'],
			],
			[
				['creator_id'], 'exist', 'skipOnError'     => true, 'targetClass' => User::className(),
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
			'id'         => Yii::t('admin', 'ID'),
			'status'     => Yii::t('admin', 'Status'),
			'var_key'    => Yii::t('admin', 'Var Key'),
			'value'      => Yii::t('admin', 'Value'),
			'created_at' => Yii::t('admin', 'Date created'),
			'updated_at' => Yii::t('admin', 'Date updated'),
			'creator_id' => Yii::t('admin', 'Creator'),
			'editor_id'  => Yii::t('admin', 'Editor'),
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
	 * @return mixed|static[]
	 */
	public static function getAllActive()
	{
		$keyCache = self::CACHE_KEY . 'all';
		$data     = Yii::$app->cacheFrontend->get($keyCache);

		if (!$data) {
			$model = self::findAll(['status' => self::STATUS_ACTIVE]);

			/** @var TextBlock $item */
			foreach ($model as $item) {
				$data[$item->getPrimaryKey()] = $item;
			}

			Yii::$app->cacheFrontend->set($keyCache, $data, self::CACHE_DURATION);
		}

		return $data;
	}

	/**
	 * @param string|integer $subKey
	 *
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

	/**
	 * @param            $key
	 * @param bool|false $returnModel
	 *
	 * @return mixed|string
	 */
	public static function getValue($key, $returnModel = false)
	{
		$setting = self::findOne([
			'var_key' => $key,
			'status'  => Setting::STATUS_ACTIVE,
		]);

		if ($returnModel) {
			return $setting;
		} else {
			return (isset($setting) && isset($setting->varValue)) ? $setting->varValue : '';
		}
	}
}
