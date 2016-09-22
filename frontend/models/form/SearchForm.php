<?php

namespace frontend\models\form;

use Yii;
use yii\base\Model;

/**
 * Class SearchForm
 * @package frontend\models
 */
class SearchForm extends Model
{
	const QUERY_TYPE_TRACK = 1;
	const QUERY_TYPE_ARTIST = 2;
	const QUERY_TYPE_ALBUM = 3;

	public $query_string;
	public $query_type;

	/**
	 * @inheritdoc
	 */
	public function rules()
	{
		return [
			[['query_string', 'query_type'], 'required'],
			['query_string', 'string', 'min' => 2, 'max' => 255],
			['query_type', 'integer'],
			[
				'query_type', 'in', 'range' => [
					self::QUERY_TYPE_TRACK,
					self::QUERY_TYPE_ARTIST,
					self::QUERY_TYPE_ALBUM
				]
			],
		];
	}

	/**
	 * @inheritdoc
	 */
	public function attributeLabels()
	{
		return [
			'query_string' => 'Search',
			'query_type'   => 'Choice type',
		];
	}

	/**
	 * @param int $type
	 *
	 * @return string
	 */
	public function getQueryType($type)
	{
		return $this->getQueryTypeList()[$type];
	}

	/**
	 * @return array
	 */
	public function getQueryTypeList()
	{
		return [
			self::QUERY_TYPE_TRACK  => 'track', //Yii::t('app', 'track'),
			self::QUERY_TYPE_ARTIST => 'artist', //Yii::t('app', 'artist'),
			self::QUERY_TYPE_ALBUM  => 'album', //Yii::t('app', 'album'),
		];
	}
}