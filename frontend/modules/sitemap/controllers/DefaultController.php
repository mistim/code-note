<?php


namespace frontend\modules\sitemap\controllers;

use Yii;
use yii\web\Controller;

/**
 * @package frontend\modules\sitemap
 */
class DefaultController extends Controller
{
    public function actionIndex()
    {
        /** @var \frontend\modules\sitemap\Module $module */
        $module = $this->module;

        if (!$sitemapData = $module->cacheProvider->get($module->cacheKey)) {
            $sitemapData = $module->buildSitemap();
        }

        Yii::$app->response->format = \yii\web\Response::FORMAT_RAW;
        $headers = Yii::$app->response->headers;
        $headers->add('Content-Type', 'application/xml');

        if ($module->enableGzip) {
            $sitemapData = gzencode($sitemapData);
            $headers->add('Content-Encoding', 'gzip');
            $headers->add('Content-Length', strlen($sitemapData));
        }

        return $sitemapData;
    }
}