<?php

namespace frontend\components\yandex;

/**
 * Class Api
 * @package frontend\components\yandex
 */
abstract class Api
{
	protected $host;
	protected $config;
	/** @var \GuzzleHttp\Client */
	protected $client;

	public function __construct()
	{
		$this->client = new \GuzzleHttp\Client();
		$this->config = require_once __DIR__ . '/config/music.php';
	}

	public function test()
	{
		return $this->config['user'];
	}
}