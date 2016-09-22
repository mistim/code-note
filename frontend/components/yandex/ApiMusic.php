<?php

namespace frontend\components\yandex;

use yii\helpers\Json;

class ApiMusic extends Api
{
	protected $host = 'https://api.music.yandex.net';
	protected $access_token;
	protected $uid;

	public function __construct($access_toke, $uid)
	{
		parent::__construct();

		$this->access_token = $access_toke;
		$this->uid = $uid;
	}

	public function search($query_string, $query_type = 'all', $page = 0)
	{
		$res = $this->client->request('GET', $this->addUrlPath('/search'), [
			'headers' => [
				'Authorization' => $this->addAuthHeader()
			],
			'query' => [
				'type'       => $query_type,
				'text'       => $query_string,
				'page'       => $page,
				'nococrrect' => false,
			]
		]);

		return Json::decode($res->getBody()->getContents());
	}

	protected function addUrlPath($path)
	{
		return $this->host . $path;
	}

	protected function addAuthHeader()
	{
		return'OAuth' . $this->access_token;
	}
}