<?php

namespace common\components;

use Yii;
use yii\helpers\ArrayHelper;
use yii\web\NotFoundHttpException;
use yii\web\UrlManager;

/**
 * Class I18nUrlManager
 * @package pheme\i18n
 */
class I18nUrlManager extends UrlManager
{
    /**
     * @var array Supported languages
     */
    public $languages;

    /**
     * @var array Language aliases
     */
    public $aliases = [];

    /**
     * @var bool Whether to display the source app language in the URL
     */
    public $displaySourceLanguage = true;

    /**
     * @var string Parameter used to set the language
     */
    public $languageParam = 'lang';

    /**
     * @inheritdoc
     */
    public function init()
    {
        if (is_callable($this->languages))
        {
            $this->languages = call_user_func($this->languages);
        }

        if (empty($this->languages))
        {
            $this->languages = [Yii::$app->language => Yii::$app->language];
        }

        parent::init();
    }

    /**
     * Parses the URL and sets the language accordingly
     * @param \yii\web\Request $request
     * @return array|bool
     */
    public function parseRequest($request)
    {
        if ($this->enablePrettyUrl)
        {
            $pathInfo = $request->getPathInfo();
            $language = explode('/', $pathInfo);
            $locale = $this->getLocal($language[0], $request);
            $language = $this->languages[$locale];

            if (in_array($language, $this->languages, true))
            {
                $request->setPathInfo(substr_replace($pathInfo, '', 0, (strlen($locale) + 1)));
                Yii::$app->language = $locale;
            }
        }
        else
        {
            $params = $request->getQueryParams();
            $route = isset($params[$this->routeParam]) ? $params[$this->routeParam] : '';

            if (is_array($route))
            {
                $route = '';
            }

            $language = explode('/', $route)[0];
            $locale = $this->getLocal($language, $request);
            $language = $this->languages[$locale];

            if (in_array($language, $this->languages, true))
            {
                $route = substr_replace($route, '', 0, (strlen($locale) + 1));
                $params[$this->routeParam] = $route;
                $request->setQueryParams($params);
                Yii::$app->language = $locale;
            }
        }

        return parent::parseRequest($request);
    }

    /**
     * Adds language functionality to URL creation
     * @param array|string $params
     * @return string
     */
    public function createUrl($params)
    {
        $params = (array)$params;

        if (array_key_exists($this->languageParam, $params))
        {
            $lang = $params[$this->languageParam];

            if (
                (($lang !== Yii::$app->sourceLanguage && ArrayHelper::getValue($this->aliases, $lang) !== Yii::$app->sourceLanguage)
                    || $this->displaySourceLanguage) && !empty($lang)
            )
            {
                $params[0] = $lang . '/' . ltrim($params[0], '/');
            }

            unset($params[$this->languageParam]);
        }
        else
        {
            if (Yii::$app->language !== Yii::$app->sourceLanguage || $this->displaySourceLanguage)
            {
                $params[0] = Yii::$app->language . '/' . ltrim($params[0], '/');
            }
        }

        return parent::createUrl($params);
    }

    /**
     * @param $language
     * @param \yii\web\Request $request
     * @return mixed
     * @throws NotFoundHttpException
     */
    protected function getLocal($language, $request)
    {
        $currentLanguage = $request->cookies->getValue('lang', Yii::$app->language);

        if (!$language || empty($language))
        {
            header('Location: /' . $currentLanguage);
            exit;
        }

        if (array_key_exists($language, $this->languages))
        {
            if ($language !== $request->cookies->get('lang'))
            {
                Yii::$app->response->cookies->add(new \yii\web\Cookie([
                    'name' => 'lang',
                    'value' => $language,
                ]));
            }

            return $language;
        }
        else
        {
            header('Location: /' . $currentLanguage);
            exit;
        }
    }

    /**
     * @return array
     * @throws \yii\base\InvalidConfigException
     */
    public function getSwitcher()
    {
        $data = [];
        $currentURL = str_replace(Yii::$app->urlManager->getHostInfo() . '/' .  Yii::$app->language, '', Yii::$app->request->getPathInfo());

        foreach (Yii::$app->urlManager->languages as $code => $language) {
            if (Yii::$app->language === $code) {
                $data[] = [
                    'label' => $code, 'url' => '/' . $code . '/' . $currentURL, 'active' => true
                ];
            } else {
                $data[] = [
                    'label' => $code, 'url' => '/' . $code . '/' . $currentURL
                ];
            }
        }

        return $data;
    }
}