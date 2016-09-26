<?php

namespace frontend\controllers;

use common\models\Category;
use common\models\Note;
use common\models\search\NoteSearch;
use yii\data\ActiveDataProvider;
use yii\web\NotFoundHttpException;
use Yii;

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

	public function actionCategory($alias)
	{
		if (($model = Category::getActiveByAlias($alias)) !== null) {
			$model->meta_tag->status && $this->setSeo(
				$model->meta_tag->title,
				$model->meta_tag->keyword,
				$model->meta_tag->description
			);

			$searchModel = new NoteSearch();
			$searchModel->category_id = $model->getPrimaryKey();
			$dataProvider = $searchModel->search(Yii::$app->request->queryParams);
			$dataProvider->sort->defaultOrder = [
				'posted_at' => SORT_DESC,
			];

			return $this->render('index', [
				'model'        => $model,
				'dataProvider' => $dataProvider,
			]);
		} else {
			throw new NotFoundHttpException('The requested page does not exist.');
		}
	}
}