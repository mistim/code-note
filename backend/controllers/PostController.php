<?php

namespace backend\controllers;

use backend\widgets\fileapi\actions\UploadAction;
use common\models\MetaTag;
use common\models\PostTag;
use common\models\Tag;
use Yii;
use common\models\Post;
use common\models\search\PostSearch;
use backend\controllers\BaseController;
use yii\helpers\Json;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * PostController implements the CRUD actions for Post model.
 */
class PostController extends BaseController
{
    /**
     * @inheritdoc
     */
    public function actions()
    {
        return [
            'fileapi-upload' => [
                'class' => UploadAction::className(),
                'path'  => Post::IMAGE_TMP,
            ],
        ];
    }

    /**
     * Lists all Post models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new PostSearch();
        $searchModel->is_post = Post::IS_POST;
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Post model.
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
     * Creates a new Post model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        /** @var Post $model */
        $model = new Post();
        $model->scenario = 'crud';
        /** @var Tag[] $tags */
        $tags = Tag::getAllActive();
        /** @var MetaTag $meta_tag */
        $meta_tag = new MetaTag();

        if (
            $model->load(Yii::$app->request->post()) && $model->validate() &&
            $meta_tag->load(Yii::$app->request->post()) && $meta_tag->validate() &&
            $model->saveWithMetaTag($meta_tag)
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
     * Updates an existing Post model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        /** @var Post $model */
        $model = $this->findModel($id);
        $model->scenario = 'crud';
        /** @var Tag[] $tags */
        $tags = Tag::getAllActive();
        /** @var MetaTag $meta_tag */
        $meta_tag = $model->getMeta_tag()->one();

        if (
            $model->load(Yii::$app->request->post()) && $model->validate() &&
            $meta_tag->load(Yii::$app->request->post()) && $meta_tag->validate() &&
            $model->saveWithMetaTag($meta_tag)
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
     * Deletes an existing Post model.
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
     * Finds the Post model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Post the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Post::findOne($id)) !== null)
        {
            return $model;
        }
        else
        {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
