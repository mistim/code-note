<?php

namespace frontend\controllers;

use common\models\Category;
use common\models\Post;
use common\models\search\PostSearch;
use common\models\Tag;
use yii\data\ActiveDataProvider;
use yii\web\NotFoundHttpException;
use Yii;

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
				['is_post' => Post::IS_POST],
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
			$model->meta_tag->status && $this->setSeo(
				$model->meta_tag->title,
				$model->meta_tag->keyword,
				$model->meta_tag->description
			);
			$model->updateCnt();

			return $this->render('view', [
				'model' => $model,
			]);
		} else {
			throw new NotFoundHttpException('The requested page does not exist.');
		}
	}

	/**
	 * @param $alias
	 *
	 * @return string
	 * @throws NotFoundHttpException
	 */
	public function actionCategory($alias)
	{
		if (($model = Category::getActiveByAlias($alias)) !== null) {
			$model->meta_tag->status && $this->setSeo(
				$model->meta_tag->title,
				$model->meta_tag->keyword,
				$model->meta_tag->description
			);

			$searchModel = new PostSearch();
			$searchModel->is_post = Post::IS_POST;
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

	/**
	 * @param $alias
	 *
	 * @return string
	 * @throws NotFoundHttpException
	 */
	public function actionTag($alias)
	{
		if (($model = Tag::getActiveByAlias($alias)) !== null) {
			$model->meta_tag->status && $this->setSeo(
				$model->meta_tag->title,
				$model->meta_tag->keyword,
				$model->meta_tag->description
			);

			$searchModel = new PostSearch();
			$searchModel->is_post = Post::IS_POST;
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