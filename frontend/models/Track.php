<?php

namespace app\models;

use Yii;
use yii\base\Model;

/**
 * Class Track
 * @package app\models
 */
class Track extends Model
{
	public $id;
	public $storageDir;
	public $durationMs;
	public $explicit;
	public $title;
	public $available;
	public $availableAsRbt;
	public $version;
	public $regions;

	public $artists;
	public $albums;
}