<?php

namespace frontend\helpers;

use yii\helpers\Html;

/**
 * Class ViewTools
 * @package frontend\helpers
 */
class ViewTools
{
	/**
	 * @param $model
	 *
	 * @return array
	 */
	public static function getTagLinks($model)
	{
		$data = [];

		foreach ($model->tags as $tag) {
			$data[$tag->id] = Html::a(
				$tag->title,
				[($model->is_post ? '/post' : '/note') . '/tag/' . $tag->alias]
			);
		}

		return $data;
	}
}