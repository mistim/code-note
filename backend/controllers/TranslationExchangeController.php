<?php

namespace backend\controllers;

use backend\models\form\ExcelExchangeForm;
use Yii;
use yii\web\UploadedFile;

/**
 * Class TranslationExchangeController
 * @package backend\controllers
 */
class TranslationExchangeController extends BaseController
{
    /**
     * @param $category
     * @return void|\yii\web\Response
     */
    public function actionImport($category)
    {
        $model = new ExcelExchangeForm([
            'category' => $category
        ]);

        if ($model->validate()) {
            return $model->import();
        } else {
            Yii::$app->getSession()->setFlash('success', Yii::t('admin', 'Error import!'));
        }

        return $this->redirect(['/translation-admin']);
    }

    /**
     * @param $category
     * @return void|\yii\web\Response
     */
    public function actionExport($category)
    {
        $model = new ExcelExchangeForm([
            'category' => $category
        ]);

        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            $model->file = UploadedFile::getInstance($model, 'file');

            if ($model->upload()) {
                if ( $model->export()) {
                    Yii::$app->getSession()->setFlash('success', Yii::t('admin', 'Translations has been exported successfully!'));
                } else {
                    Yii::$app->getSession()->setFlash('danger', Yii::t('admin', 'Error export!'));
                }
            } else {
                Yii::$app->getSession()->setFlash('danger', Yii::t('admin', 'Error upload file!'));
            }
        } else {
            Yii::$app->getSession()->setFlash('danger', Yii::t('admin', 'Error export!'));
        }

        return $this->redirect(['/translation-' . ($category === 'admin' ? $category : 'public') ]);
    }
}