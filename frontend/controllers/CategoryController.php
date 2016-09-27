<?php

namespace frontend\controllers;

use common\models\Category;
use common\models\search\PostNoteSearch;
use common\models\search\PostSearch;
use Yii;
use yii\data\ActiveDataProvider;
use yii\web\NotFoundHttpException;
use yii\db\Query;

/**
 * Class CategoryController
 * @package frontend\controllers
 */
class CategoryController extends BaseController
{
	public function actionIndex($alias)
	{
		if (($model = Category::getActiveByAlias($alias)) !== null) {
			$model->meta_tag->status && $this->setSeo(
				$model->meta_tag->title,
				$model->meta_tag->keyword,
				$model->meta_tag->description
			);

			$searchModel = new PostSearch();
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