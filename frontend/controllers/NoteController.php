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
			'query' => Note::find()->where([
				'AND',
				['status' => Note::STATUS_ACTIVE],
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
		if (($model = Note::getActiveByAlias($alias)) !== null) {

			$model->meta_tag->status && $this->setSeo(
				$model->meta_tag->title,
				$model->meta_tag->keyword,
				$model->meta_tag->description
			);

			return $this->render('view', [
				'model' => $model,
			]);
		} else {
			throw new NotFoundHttpException('The requested page does not exist.');
		}
	}
}