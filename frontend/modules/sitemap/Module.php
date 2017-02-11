<?php

namespace frontend\modules\sitemap;

use Yii;
use yii\base\InvalidConfigException;
use yii\caching\Cache;

/**
 * Yii2 module for automatically generating XML Sitemap.
 *
 * @package frontend\modules\sitemap
 */
class Module extends \yii\base\Module
{
    public $controllerNamespace = 'frontend\modules\sitemap\controllers';
    /** @var int */
    public $cacheExpire = 86400;
    /** @var Cache|string */
    public $cacheProvider = 'cache';
    /** @var string */
    public $cacheKey = 'sitemap';
    /** @var boolean Use php's gzip compressing. */
    public $enableGzip = false;
    /** @var array */
    public $models = [];
    /** @var array */
    public $urls = [];
    public function init()
    {
        parent::init();
        if (is_string($this->cacheProvider)) {
            $this->cacheProvider = Yii::$app->{$this->cacheProvider};
        }
        if (!$this->cacheProvider instanceof Cache) {
            throw new InvalidConfigException('Invalid `cacheKey` parameter was specified.');
        }
    }
    /**
     * Build and cache a site map.
     * @return string
     * @throws \yii\base\InvalidConfigException
     */
    public function buildSitemap()
    {
        $urls = $this->urls;
        foreach ($this->models as $modelName) {
            /** @var behaviors\SitemapBehavior $model */
            if (is_array($modelName)) {
                $model = new $modelName['class'];
                if (isset($modelName['behaviors'])) {
                    $model->attachBehaviors($modelName['behaviors']);
                }
            } else {
                $model = new $modelName;
            }
            $urls = array_merge($urls, $model->generateSiteMap());
        }
        $sitemapData = $this->createControllerByID('default')->renderPartial('index', [
            'urls' => $urls
        ]);
        $this->cacheProvider->set($this->cacheKey, $sitemapData, $this->cacheExpire);
        return $sitemapData;
    }
}