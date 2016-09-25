<?php

namespace frontend\controllers;

use common\models\Post;
use yii\data\ActiveDataProvider;
use yii\web\NotFoundHttpException;

/**
 * Class PostController
 * @package frontend\controllers
 */
class PostController extends BaseController
{
	/**
	 * @return string
	 */
	public function actionIndex()
	{
		$dataProvider = new ActiveDataProvider([
			'query' => Post::find()->where([
				'AND',
				['status' => Post::STATUS_ACTIVE],
				[
					'OR',
					['<', 'posted_at', date('Y-m-d 00:00:00')],
					['posted_at' => date('Y-m-d 00:00:00')]
				]
			]),
			'pagination' => [
				'pageSize' => 5,
			],
			'sort' => [
				'defaultOrder' => [
					'posted_at' => SORT_DESC
				]
			]
		]);

		return $this->render('index', [
			'dataProvider' => $dataProvider,
		]);
	}

	/**
	 * @param $alias
	 *
	 * @return string
	 * @throws NotFoundHttpException
	 */
	public function actionView($alias) {
		if (($model = Post::getActiveByAlias($alias)) !== null) {
			return $this->render('view', [
				'model' => $model,
			]);
		} else {
			throw new NotFoundHttpException('The requested page does not exist.');
		}
	}
}