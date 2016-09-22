<?php
namespace backend\controllers;

use Yii;
use yii\filters\VerbFilter;
use yii\web\Controller;
use backend\modules\rbac\components\AccessControl;

/**
 * Class BaseController
 * @package backend\controllers
 */
class BaseController extends Controller
{
	/** @var bool $sidebarCollapse */
	public $sidebarCollapse = false;

	/**
	 * @return array
	 */
	public function behaviors()
	{
		return [
			'access' => [
				'class' => AccessControl::className(),
			],
			'verbs'  => [
				'class'   => VerbFilter::className(),
				'actions' => [
					'logout'         => ['post'],
					'delete'         => ['post'],
					'fileapi-delete' => ['delete'],
				],
			],
		];
	}

	/**
	 * @inheritdoc
	 */
	public function init()
	{
		parent::init();

		Yii::$app->getView()->params['sidebar-collapse'] = $this->sidebarCollapse;
	}
}