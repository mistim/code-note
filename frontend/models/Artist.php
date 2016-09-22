<?php

namespace app\models;

use Yii;
use yii\base\Model;

/**
 * Class Artist
 * @package app\models
 */
class Artist extends Model
{
	public $id;
	public $various;
	public $name;
	public $cover;
	public $composer;
	public $decomposed;
}