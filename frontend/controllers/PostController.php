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
		$dataProvider = Post::getDataProvider();
        $this->setSeo(Yii::t('app', 'Posts'));

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
			$this->setSeoByModel($model);
			$model->updateCnt();

			return $this->render('view', [
				'model' => $model,
				'prev'  => $model->getPrev(),
				'next'  => $model->getNext(),
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
		if (($model = Category::getActiveByAlias($alias, true)) !== null) {
			$this->setSeoByModel($model);

            if ($model->countNotes('_post_' . $model->alias)) {
                $searchModel = new PostSearch();
                $searchModel->is_post = Post::IS_POST;
                $searchModel->category_id = $model->getPrimaryKey();
                $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
                $dataProvider->sort->defaultOrder = [
                    'posted_at' => SORT_DESC,
                ];
            } else {
                $dataProvider = null;
            }

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
		if (($model = Tag::getActiveByAlias($alias, true)) !== null) {
			$this->setSeoByModel($model);

            if ($model->countNotes('_post_' . $model->alias)) {
                $searchModel = new PostSearch();
                $searchModel->status = Post::STATUS_ACTIVE;
                $searchModel->is_post = Post::IS_POST;
                $searchModel->tag_id = $model->getPrimaryKey();
                $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
                $dataProvider->sort->defaultOrder = [
                    'posted_at' => SORT_DESC,
                ];
            } else {
                $dataProvider = null;
            }

			return $this->render('index', [
				'model'        => $model,
				'dataProvider' => $dataProvider,
			]);
		} else {
			throw new NotFoundHttpException('The requested page does not exist.');
		}
	}
}