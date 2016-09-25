<?php

namespace frontend\controllers;

use common\models\Note;
use yii\data\ActiveDataProvider;
use yii\web\NotFoundHttpException;

/**
 * Class NoteController
 * @package frontend\controllers
 */
class NoteController extends BaseController
{
	/**
	 * @return string
	 */
	public function actionIndex()
	{
		$dataProvider = new ActiveDataProvider([
			'query' => Note::find(),
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
		if (($model = Note::getActiveByAlias($alias)) !== null) {
			return $this->render('view', [
				'model' => $model,
			]);
		} else {
			throw new NotFoundHttpException('The requested page does not exist.');
		}
	}
}