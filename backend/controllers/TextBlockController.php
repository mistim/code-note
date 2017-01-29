<?php

namespace backend\controllers;

use backend\widgets\fileapi\actions\UploadAction;
use Yii;
use common\models\TextBlock;
use common\models\search\TextBlockSearch;
use yii\bootstrap\ActiveForm;
use yii\helpers\Json;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\web\Response;

/**
 * TextBlockController implements the CRUD actions for TextBlock model.
 */
class TextBlockController extends Controller
{
    /**
     * @inheritdoc
     */
    public function actions()
    {
        return [
            'fileapi-upload' => [
                'class' => UploadAction::className(),
                'path'  => TextBlock::IMAGE_TMP,
            ],
        ];
    }

    /**
     * Lists all TextBlock models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new TextBlockSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel'  => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single TextBlock model.
     * @param string $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new TextBlock model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new TextBlock();
        $model->status = TextBlock::STATUS_ACTIVE;

        /*if (Yii::$app->request->isAjax && $model->load(Yii::$app->request->post())) {
            Yii::$app->response->format = Response::FORMAT_JSON;
            return ActiveForm::validate($model);
        }*/

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            Yii::$app->getSession()->setFlash('success', Yii::t('admin', 'Entry has been saved successfully!'));

            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing TextBlock model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param string $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            Yii::$app->getSession()->setFlash('success', Yii::t('admin', 'Entry has been saved successfully!'));

            return $this->redirect(['view', 'id' => $model->id]);
        } else {
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
     * Deletes an existing TextBlock model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param string $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        Yii::$app->getSession()->setFlash('success', Yii::t('admin', 'Entry has been deleted successfully!'));

        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the TextBlock model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $id
     * @return TextBlock the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = TextBlock::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
