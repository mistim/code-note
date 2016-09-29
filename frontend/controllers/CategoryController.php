<?php

namespace frontend\controllers;

use common\models\Category;
use common\models\Post;
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
			$this->setSeoByModel($model);

			$searchModel = new PostSearch();
			$searchModel->status = Post::STATUS_ACTIVE;
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