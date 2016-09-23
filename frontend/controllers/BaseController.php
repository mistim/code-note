<?php

namespace frontend\controllers;

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

        //$this->setMetaTags();
    }

    /**
     * @param $title
     * @param $keywords
     * @param $description
     */
    public function setSeo($title = null, $keywords = null, $description = null)
    {
        $this->getView()->params['title'] = $this->getView()->params['title'] ?: $title;
        $this->getView()->params['keywords'] = $this->getView()->params['keywords'] ?: $keywords;
        $this->getView()->params['description'] = $this->getView()->params['description'] ?: $description;
    }

    /**
     * @param $title
     * @param $keywords
     * @param $description
     */
    private function setMetaTags($title = null, $keywords = null, $description = null)
    {
        $route = str_replace(Yii::$app->urlManager->getHostInfo() . '/' . Yii::$app->language, '', Yii::$app->request->absoluteUrl);
        $route = $route ?: '/';

        $model = Seo::getActiveByLink($route);

        if ($model) {
            $this->getView()->params['title'] = $model->{'title_' . Yii::$app->language};
            $this->getView()->params['keywords'] = $model->{'keywords_' . Yii::$app->language};
            $this->getView()->params['description'] = $model->{'description_' . Yii::$app->language};
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