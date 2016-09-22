<?php

namespace backend\helpers;

use yii\helpers\Html;

/**
 * Class ToolsHelper
 * @package backend\helpers
 */
class ToolsHelper
{
	/** @var array  */
	protected static $status_list = [
		'disabled',
		'enabled'
	];

	protected static $status_class = [
		'new badge bg-orange',
		'new badge bg-green',
	];

	/**
	 * @param null $status
	 *
	 * @return array|null|string
	 */
	public static function getStatusStr($status = null) {
		if ($status !== null) {
			return array_key_exists($status, self::$status_list)
				? Html::tag('span', self::$status_list[$status], ['class' => self::$status_class[$status]])
				: null;
		} else {
			return self::$status_list;
		}
	}
}