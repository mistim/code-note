<?php

namespace frontend\controllers;

use common\models\Category;
use common\models\Note;
use common\models\search\NoteSearch;
use common\models\Tag;
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
		$dataProvider = Note::getDataProvider();

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
		if (($model = Category::getActiveByAlias($alias)) !== null) {
			$this->setSeoByModel($model);

            if ($model->countNotes('_note_' . $model->alias)) {
                $searchModel = new NoteSearch();
                $searchModel->status = Note::STATUS_ACTIVE;
                $searchModel->is_post = Note::IS_POST;
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
		if (($model = Tag::getActiveByAlias($alias)) !== null) {
			$this->setSeoByModel($model);

            if ($model->countNotes('_note_' . $model->alias)) {
                $searchModel = new NoteSearch();
                $searchModel->is_post = Note::IS_POST;
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