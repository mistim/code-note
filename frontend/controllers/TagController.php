<?php

namespace frontend\controllers;

use common\models\Post;
use common\models\search\NoteSearch;
use common\models\search\PostSearch;
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

			$searchModel = new PostSearch();
			$searchModel->status = Post::STATUS_ACTIVE;
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