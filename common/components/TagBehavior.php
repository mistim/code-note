<?php

namespace common\components;

use yii\base\Behavior;

/**
 * Class TagBehavior
 * @package common\components
 *
 */
class TagBehavior extends Behavior
{
	/** @var array */
	public $list_tag_id = [];
	/** @var array */
	public $list_tag = [];

	/**
	 * @param $tags
	 */
	public function setListTagID($tags)
	{
		foreach ($tags as $item)
		{
			$this->list_tag_id[] = $item->id;
		}
	}

	/**
	 * @param $tags
	 */
	public function setListTag($tags)
	{
		foreach ($tags as $item)
		{
			$this->list_tag[] = $item->title;
		}
	}

	/**
	 * @param $tags
	 *
	 * @return string
	 */
	public function getListTagStr($tags)
	{
		$data = [];

		foreach ($tags as $tag)
		{
			$data[$tag->id] =  $tag->title;
		}

		return implode('; ',  $data);
	}
}