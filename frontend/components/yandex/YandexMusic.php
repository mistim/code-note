<?php

namespace frontend\components\yandex;

/**
 * Class YandexMusic
 * @package frontend\components\yandex
 */
class YandexMusic
{
	/** @var ApiAuthMusic  */
	protected $auth;
	/** @var ApiMusic  */
	protected $api;

	/**
	 * Protected constructor to prevent creating a new instance of the
	 * *Singleton* via the `new` operator from outside of this class.
	 */
	protected function __construct()
	{
		$this->auth = (new ApiAuthMusic())->auth('ya.m-music', '231401M7#');
		$this->api = new ApiMusic(
			$this->auth->getToken(),
			$this->auth->getUid()
		);
	}

	/**
	 * Private clone method to prevent cloning of the instance of the
	 * *Singleton* instance.
	 *
	 * @return void
	 */
	private function __clone() {}

	/**
	 * Private unserialize method to prevent unserializing of the *Singleton*
	 * instance.
	 *
	 * @return void
	 */
	private function __wakeup() {}

	/**
	 * Returns the *Singleton* instance of this class.
	 *
	 * @staticvar Singleton $instance The *Singleton* instances of this class.
	 *
	 * @return YandexMusic The *Singleton* instance.
	 */
	public static function getInstance()
	{
		static $instance;

		if ($instance === null) {
			$instance = new static;
		}

		return $instance;
	}

	public function search($query_string, $query_type)
	{
		return $this->api->search($query_string, $query_type);
	}
}