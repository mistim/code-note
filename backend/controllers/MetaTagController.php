<?php

namespace backend\controllers;

use Yii;
use common\models\MetaTag;
use common\models\search\MetaTagSearch;
use backend\controllers\BaseController;
use yii\helpers\Json;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * MetaTagController implements the CRUD actions for MetaTag model.
 */
class MetaTagController extends BaseController
{
    /**
     * Lists all MetaTag models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new MetaTagSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single MetaTag model.
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
     * Creates a new MetaTag model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new MetaTag();

        if ($model->load(Yii::$app->request->post()) && $model->save())
        {
            Yii::$app->getSession()->setFlash('success', Yii::t('admin', 'Entry has been saved successfully!'));

            return $this->redirect(['view', 'id' => $model->id]);
        }
        else
        {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing MetaTag model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save())
        {
            Yii::$app->getSession()->setFlash('success', Yii::t('admin', 'Entry has been saved successfully!'));

            return $this->redirect(['view', 'id' => $model->id]);
        }
        else
        {
            return $this->render('update', [
                'model' => $model,
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
     * Deletes an existing MetaTag model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        Yii::$app->getSession()->setFlash('success', Yii::t('admin', 'Entry has been deleted successfully!'));

        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the MetaTag model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return MetaTag the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = MetaTag::findOne($id)) !== null)
        {
            return $model;
        }
        else
        {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
