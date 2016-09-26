<?php

namespace frontend\controllers;

use common\models\search\NoteSearch;
use common\models\Tag;
use Yii;
use yii\web\NotFoundHttpException;

/**
 * Class TagController
 * @package frontend\controllers
 */
class TagController extends BaseController
{
	public function actionIndex($alias)
	{
		if (($model = Tag::getActiveByAlias($alias)) !== null) {
			$model->meta_tag->status && $this->setSeo(
				$model->meta_tag->title,
				$model->meta_tag->keyword,
				$model->meta_tag->description
			);

			$searchModel = new PostNoteSearch();
			$searchModel->tag_id = $model->getPrimaryKey();
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