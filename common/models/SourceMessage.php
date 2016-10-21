<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "source_message".
 *
 * @property integer   $id
 * @property string    $category
 * @property string    $message
 *
 * @property Message[] $messages
 */
class SourceMessage extends \yii\db\ActiveRecord
{
	public $translation_uk;
	public $translation_en;
	public $translation_ru;

	/**
	 * @inheritdoc
	 */
	public static function tableName()
	{
		return 'source_message';
	}

	/**
	 * @inheritdoc
	 */
	public function rules()
	{
		return [
			[['category'], 'required'],
			[['message', 'translation_en', 'translation_uk', 'translation_ru'], 'string'],
			[['category'], 'string', 'max' => 32],
		];
	}

	/**
	 * @inheritdoc
	 */
	public function attributeLabels()
	{
		return [
			'id'             => Yii::t('admin', 'ID'),
			'category'       => Yii::t('admin', 'Category'),
			'message'        => Yii::t('admin', 'Message'),
			'translation_uk' => Yii::t('admin', 'UA'),
			'translation_en' => Yii::t('admin', 'EN'),
			'translation_ru' => Yii::t('admin', 'RU'),
		];
	}

	/**
	 * @return \yii\db\ActiveQuery
	 */
	public function getMessages()
	{
		return $this->hasMany(Message::className(), ['id' => 'id']);
	}

	/**
	 * @inheritdoc
	 */
	public function prepareTranslation()
	{
		foreach ($this->messages as $item) {
			$this->{'translation_' . $item->language} = $item->translation;
		}
	}

	/**
	 * @return bool
	 * @throws \Exception
	 */
	public function addTranslation($languages = null)
	{
		$langKey   = [];
		$languages = $languages ? $languages : [
			//'uk' => 'Український',
			//'en' => 'English',
			'ru' => 'Русский',
		];

		foreach ($languages as $code => $lang) {
			$langKey[$code] = $this->{'translation_' . $code};
		}

		return Message::addTranslate($this->id, $langKey);
	}
}
