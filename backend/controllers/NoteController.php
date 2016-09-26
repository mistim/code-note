<?php

namespace backend\controllers;

use common\models\MetaTag;
use common\models\Tag;
use Yii;
use common\models\Note;
use common\models\search\NoteSearch;
use backend\controllers\BaseController;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * NoteController implements the CRUD actions for Note model.
 */
class NoteController extends BaseController
{
    /**
     * Lists all Note models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new NoteSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Note model.
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
     * Creates a new Note model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        /** @var Note $model */
        $model = new Note();
        /** @var Tag[] $tags */
        $tags = Tag::getAllActive();
        /** @var MetaTag $meta_tag */
        $meta_tag = new MetaTag();

        if (
            $model->load(Yii::$app->request->post()) &&
            $meta_tag->load(Yii::$app->request->post()) &&
            $model->saveWithMetaKay($meta_tag)
        )
        {
            Yii::$app->getSession()->setFlash('success', Yii::t('app', 'Entry has been saved successfully!'));

            return $this->redirect(['view', 'id' => $model->id]);
        }
        else
        {
            $model->setListTag($model->tags);

            return $this->render('create', [
                'model'    => $model,
                'tags'     => $tags,
                'meta_tag' => $meta_tag,
            ]);
        }
    }

    /**
     * Updates an existing Note model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        /** @var Note $model */
        $model = $this->findModel($id);
        /** @var Tag[] $tags */
        $tags = $model->getTags()->all();
        /** @var MetaTag $meta_tag */
        $meta_tag = $model->getMeta_tag()->one();

        if (
            $model->load(Yii::$app->request->post()) &&
            $meta_tag->load(Yii::$app->request->post()) &&
            $model->saveWithMetaKay($meta_tag)
        )
        {
            Yii::$app->getSession()->setFlash('success', Yii::t('app', 'Entry has been saved successfully!'));

            return $this->redirect(['view', 'id' => $model->id]);
        }
        else
        {
            $model->setListTag($model->tags);

            return $this->render('update', [
                'model'    => $model,
                'tags'     => $tags,
                'meta_tag' => $meta_tag,
            ]);
        }
    }

    /**
     * Deletes an existing Note model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        Yii::$app->getSession()->setFlash('success', Yii::t('app', 'Entry has been deleted successfully!'));

        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Note model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Note the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Note::findOne($id)) !== null)
        {
            return $model;
        }
        else
        {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
