<?php

namespace frontend\controllers;

use common\models\Category;
use common\models\search\PostNoteSearch;
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

			$queryPost = (new Query())
				->select('*, CONCAT(0) AS is_post')
				->from('post')
				->where(['category_id' => $model->getPrimaryKey()]);

			$queryNote = (new Query())
				->select('*, CONCAT(0) AS image, CONCAT(0) AS is_post')
				->from('note')
				->where(['category_id' => $model->getPrimaryKey()]);

			$unionQuery = (new Query())
				->from(['post_note' => $queryPost->union($queryNote, true)])
				->orderBy(['posted_at' => SORT_ASC]);

			/*$query1->union($query2, false);//false is UNION, true is UNION ALL
			$sql = $query1->createCommand()->getRawSql();
			$sql .= ' ORDER BY id DESC';
			$query = User::findBySql($sql);*/

			$dataProvider = new ActiveDataProvider([
				'query' => $unionQuery,
				'pagination' => [
					'pageSize' => 20,
				],
			]);

			/*$dataProvider->sort->defaultOrder = [
				'posted_at' => SORT_DESC,
			];*/

			return $this->render('index', [
				'model'        => $model,
				'dataProvider' => $dataProvider,
			]);
		} else {
			throw new NotFoundHttpException('The requested page does not exist.');
		}
	}
}