<?php

namespace frontend\controllers;

use common\models\MetaTag;
use common\models\Seo;
use common\models\Setting;
use yii\web\Controller;
use Yii;

/**
 * Class BaseController
 * @package frontend\controllers
 */
class BaseController extends Controller
{
    public function actions()
    {
        return [
            'error'   => [
                'class' => 'yii\web\ErrorAction',
                'view' => 'error.twig'
            ],
            'captcha' => [
                'class'           => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null, // YII_ENV_DEV
                'foreColor'       => 0x26a69a,
                'offset'          => 1,
                'maxLength'       => 7
            ],
        ];
    }

    /**
     * @inheritdoc
     */
    public function init()
    {
        parent::init();

        /** @var Setting $setting */
        $setting = Setting::getAllActive();

        if ($setting) {
            foreach ($setting as $item) {
                $this->getView()->params[$item->var_key] = $item->{'value_' . Yii::$app->language};
            }
        }

        $this->setMetaTags();
    }

    /**
     * @param $title
     * @param $keywords
     * @param $description
     */
    public function setSeo($title = null, $keywords = null, $description = null)
    {
        if ($title && !$keywords && !$description) {
            $keywords = $description = $title;
        }

        $this->getView()->params['title'] = $this->getView()->params['title'] ?: $title;
        $this->getView()->params['keywords'] = $this->getView()->params['keywords'] ?: $keywords;
        $this->getView()->params['description'] = $this->getView()->params['description'] ?: $description;
    }

    /**
     * @param $model
     */
    public function setSeoByModel($model)
    {
        $this->setSeo(
            $model->meta_tag->title
                ? $model->meta_tag->status === MetaTag::STATUS_ACTIVE && $model->meta_tag->title
                : $model->title,
            $model->meta_tag->keyword
                ? $model->meta_tag->status === MetaTag::STATUS_ACTIVE && $model->meta_tag->keyword
                : $model->title,
            $model->meta_tag->description
                ? $model->meta_tag->status === MetaTag::STATUS_ACTIVE && $model->meta_tag->description
                : $model->title
        );
    }

    /**
     * @param $title
     * @param $keywords
     * @param $description
     */
    private function setMetaTags($title = null, $keywords = null, $description = null)
    {
        // TODO Если нез данных для SEO, забить данными по умолчанию или не выводить метатеги

        $route = str_replace(Yii::$app->urlManager->getHostInfo(), '', Yii::$app->request->absoluteUrl);
        $route = $route ?: '/';

        $model = MetaTag::getActiveByLink($route);

        if ($model) {
            $this->getView()->params['title'] = $model->title;
            $this->getView()->params['keywords'] = $model->keyword;
            $this->getView()->params['description'] = $model->description;
        } else {
            $this->getView()->params['title'] = isset($this->getView()->params['title']) && $this->getView()->params['title']
                ? $this->getView()->params['title']
                : $title;

            $this->getView()->params['keywords'] = isset($this->getView()->params['keywords']) && $this->getView()->params['keywords']
                ? $this->getView()->params['keywords']
                : $keywords;

            $this->getView()->params['description'] = isset($this->getView()->params['description']) && $this->getView()->params['description']
                ? $this->getView()->params['description']
                : $description;
        }
    }
}