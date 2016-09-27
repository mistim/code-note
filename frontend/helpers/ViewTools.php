<?php

namespace frontend\helpers;

use yii\helpers\Html;
use Yii;

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

	/**
	 * @param $route
	 *
	 * @return bool
	 */
	public static function isActiveRoute($route)
	{
		return Yii::$app->controller->id === $route ? 'active' : '';
	}
}