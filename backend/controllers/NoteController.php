<?php

namespace backend\controllers;

use common\models\MetaTag;
use common\models\PostTag;
use common\models\Tag;
use Yii;
use common\models\Note;
use common\models\search\NoteSearch;
use backend\controllers\BaseController;
use yii\helpers\Json;
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
        $searchModel->is_post = Note::IS_POST;
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
        $model->scenario = 'crud';
        /** @var Tag[] $tags */
        $tags = Tag::getAllActive();
        /** @var MetaTag $meta_tag */
        $meta_tag = new MetaTag();

        if (
            $model->load(Yii::$app->request->post()) && $model->validate() &&
            $meta_tag->load(Yii::$app->request->post()) && $meta_tag->validate() &&
            $model->saveWithMetaKay($meta_tag)
        )
        {
            Yii::$app->getSession()->setFlash('success', Yii::t('admin', 'Entry has been saved successfully!'));

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
        $model->scenario = 'crud';
        /** @var Tag[] $tags */
        $tags = $model->getTags()->all();
        /** @var MetaTag $meta_tag */
        $meta_tag = $model->getMeta_tag()->one();

        if (
            $model->load(Yii::$app->request->post()) && $model->validate() &&
            $meta_tag->load(Yii::$app->request->post()) && $meta_tag->validate() &&
            $model->saveWithMetaKay($meta_tag)
        )
        {
            Yii::$app->getSession()->setFlash('success', Yii::t('admin', 'Entry has been saved successfully!'));

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
     * @param $id
     */
    public function actionStatus($id)
    {
        $model = $this->findModel($id);
        $model->scenario = 'update';

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            $model->clearCacheModel();
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
     * Deletes an existing Note model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $model = $this->findModel($id);
        PostTag::deleteAll(['post_id' => $model->id]);
        $model->delete();
        $model->meta_tag->delete();

        Yii::$app->getSession()->setFlash('success', Yii::t('admin', 'Entry has been deleted successfully!'));

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
