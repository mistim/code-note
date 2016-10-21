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
     * @param array ...$routes
     *
     * @return string
     */
	public static function isActiveRoute(...$routes)
	{
	    foreach ($routes as $route) {
            if (Yii::$app->controller->id === $route) {
                return 'active';
            }
        }

		return '';
	}

    /**
     * @param array ...$routes
     *
     * @return string
     */
	public static function isHide(...$routes)
    {
        foreach ($routes as $route) {
            if (Yii::$app->controller->id === $route) {
                return 'hide';
            }
        }

        return '';
    }

    /**
     * @param array ...$routes
     *
     * @return string
     */
    public static function notHide(...$routes)
    {
        foreach ($routes as $route) {
            if (Yii::$app->controller->id === $route) {
                return '';
            }
        }

        return 'hide';
    }
}