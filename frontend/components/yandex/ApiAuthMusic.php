<?php

namespace frontend\components\yandex;
use yii\helpers\Json;
use Yii;

/**
 * Class ApiAuthMusic
 * @package frontend\components\yandex
 */
class ApiAuthMusic extends Api
{
	protected $host = 'https://oauth.mobile.yandex.net/1/token';
	protected $username;
	protected $password;

	/**
	 * Protected constructor to prevent creating a new instance of the
	 * *Singleton* via the `new` operator from outside of this class.
	 */
	public function __construct()
	{
		parent::__construct();
	}

	protected function authStepOne()
	{
		$res = $this->client->request('POST', $this->host, [
			'form_params' => [
				'grant_type'    => 'password',
				'username'      => $this->username, //'ya.m-music',
				'password'      => $this->password, //'231401M7#',
				'client_id'     => $this->config['ouath_code']['client_id'],
				'client_secret' => $this->config['ouath_code']['client_secret'],
			]
		]);

		return Json::decode($res->getBody()->getContents());
	}

	protected function authStepTwo()
	{
		$data = $this->authStepOne();
		$res = $this->client->request('POST', $this->host, [
			'query' => [
				'device_id'    => $this->config['fake_device']['device_id'],
				'uuid'         => $this->config['fake_device']['uuid'],
				'package_name' => $this->config['fake_device']['package_name'],
			],
			'form_params' => [
				'grant_type'    => 'x-token',
				'access_token'  => $data['access_token'],
				'client_id'     => $this->config['oauth_token']['client_id'],
				'client_secret' => $this->config['oauth_token']['client_secret'],
			]
		]);

		return Json::decode($res->getBody()->getContents());
	}

	protected function prepareTokenUid()
	{
		$session = Yii::$app->session;
		$cache = Yii::$app->cache;
		$key = 'config_ya_music_' . $session->getId();

		if (!$cache->exists($key)) {
			$result = $this->authStepTwo();
			$cache->set($key, $result, $result['expires_in'] - 1000);
		}

		$data = $cache->get($key);

		$this->config['user']['access_token'] = $data['access_token'];
		$this->config['user']['uid'] = $data['uid'];
	}

	public function auth($username, $password)
	{
		$this->username = $username;
		$this->password = $password;

		$this->prepareTokenUid();

		return $this;
	}

	public function getToken()
	{
		return $this->config['user']['access_token'];
	}

	public function getUid()
	{
		return $this->config['user']['uid'];
	}
}