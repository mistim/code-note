<?php

namespace app\models;

use Yii;
use yii\base\Model;

/**
 * Class Album
 * @package app\models
 */
class Album extends Model
{
	public $id;
	public $storageDir;
	public $originalReleaseYear;
	public $year;
	public $title;
	public $artists;
	public $coverUri;
	public $trackCount;
	public $genre;
	public $available;
	public $rackPosition;
}