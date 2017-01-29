<?php

namespace backend\controllers;

use common\models\MetaTag;
use Yii;
use common\models\Category;
use common\models\search\CategorySearch;
use backend\controllers\BaseController;
use yii\helpers\Json;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * CategoryController implements the CRUD actions for Category model.
 */
class CategoryController extends BaseController
{
    /**
     * Lists all Category models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new CategorySearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Category model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Category model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        /** @var Category $model */
        $model = new Category();
        /** @var MetaTag $meta_tag */
        $meta_tag = new MetaTag();
        $meta_tag->entity = Category::className();

        if (
            $model->load(Yii::$app->request->post()) &&
            $meta_tag->load(Yii::$app->request->post()) &&
            $model->saveWithMetaKay($meta_tag)
        )
        {
            Yii::$app->getSession()->setFlash('success', Yii::t('admin', 'Entry has been saved successfully!'));

            return $this->redirect(['view', 'id' => $model->id]);
        }
        else
        {
            return $this->render('create', [
                'model' => $model,
                'meta_tag' => $meta_tag
            ]);
        }
    }

    /**
     * Updates an existing Category model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        /** @var Category $model */
        $model = $this->findModel($id);
        /** @var MetaTag $meta_tag */
        $meta_tag = $model->getMeta_tag()->one();

        if (
            $model->load(Yii::$app->request->post()) &&
            $meta_tag->load(Yii::$app->request->post()) &&
            $model->saveWithMetaKay($meta_tag)
        )
        {
            Yii::$app->getSession()->setFlash('success', Yii::t('admin', 'Entry has been saved successfully!'));

            return $this->redirect(['view', 'id' => $model->id]);
        }
        else
        {
            return $this->render('update', [
                'model' => $model,
                'meta_tag' => $meta_tag
            ]);
        }
    }

    /**
     * @param $id
     */
    public function actionStatus($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            $result = [
                'status' => true,
                'message' => Yii::t('admin', 'Entry has been saved successfully!')
            ];
        } else {
            $result = [
                'status' => false,
                'message' => Yii::t('admin', 'Record can not be saved!')
            ];
        }

        echo Json::encode($result);
    }

    /**
     * Deletes an existing Category model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $model = $this->findModel($id);

        if ($model->posts) {
            Yii::$app->session->setFlash('error', Yii::t('admin', 'This entry has post!'));
        } else {
            $model->delete();
            Yii::$app->getSession()->setFlash('success', Yii::t('admin', 'Entry has been deleted successfully!'));
        }

        return $this->redirect(['index']);
    }

    /**
     * Finds the Category model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Category the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Category::findOne($id)) !== null)
        {
            return $model;
        }
        else
        {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
