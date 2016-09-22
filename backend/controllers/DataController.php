<?php
namespace backend\controllers;

use Yii;
use yii\helpers\FileHelper;

/**
 * Class DataController
 * @package backend\controllers
 */
class DataController extends BaseController
{
    /**
     * @return array
     */
    public function behaviors()
    {
        $behaviors = parent::behaviors();

        $behaviors['verbs']['actions'] = array_merge(
            $behaviors['verbs']['actions'],
            [
                'delete-cache'  => ['post'],
                'delete-assets' => ['post'],
            ]
        );

        return $behaviors;
    }

    /**
     * @return string
     */
    public function actionIndex()
    {
        return $this->render('index');
    }

    /**
     * @return string
     */
    public function actionDeleteCache()
    {
        Yii::$app->cache->flush();
        Yii::$app->cacheFrontend->flush();

        Yii::$app->getSession()->setFlash('success', Yii::t('admin', 'Successfully deleted cache'));

        return $this->redirect('index');
    }

    /**
     * @return string
     */
    public function actionDeleteAssets()
    {
        $this->deleteAssets('frontend');
        $this->deleteAssets('backend');

        Yii::$app->getSession()->setFlash('success', Yii::t('admin', 'Successfully cleared assets'));

        return $this->redirect('index');
    }

    protected function deleteAssets($area)
    {
        $dir = new \DirectoryIterator(FileHelper::normalizePath(Yii::getAlias('@' . $area . '/web/assets')));

        foreach ($dir as $fileInfo) {
            if ($fileInfo->isDir() && !$fileInfo->isDot()) {
                $this->deleteTree($fileInfo->getRealPath());
            }
        }
    }

    /**
     * @return string
     */
    public function actionDeleteTwigCache()
    {
        $this->deleteTwigCache('frontend');

        Yii::$app->getSession()->setFlash('success', Yii::t('admin', 'Successfully cleared assets'));

        return $this->redirect('index');
    }

    protected function deleteTwigCache($area)
    {
        $dir = new \DirectoryIterator(FileHelper::normalizePath(Yii::getAlias('@' . $area . '/runtime/Twig')));

        foreach ($dir as $fileInfo) {
            if ($fileInfo->isDir() && !$fileInfo->isDot()) {
                $this->deleteTree($fileInfo->getRealPath());
            }
        }
    }

    /**
     * @param $dir
     * @return bool
     */
    protected function deleteTree($dir)
    {
        $files = array_diff(scandir($dir), array('.','..'));

        foreach ($files as $file) {
            (is_dir("$dir/$file")) ? $this->deleteTree("$dir/$file") : unlink("$dir/$file");
        }

        return rmdir($dir);
    }
}