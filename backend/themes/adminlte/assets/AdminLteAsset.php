<?php

namespace backend\themes\adminlte\assets;

use yii\web\AssetBundle;
use yii\base\Exception;
use Yii;

/**
 * Class AdminLteAsset
 * @package backend\themes\adminlte\assets
 */
class AdminLteAsset extends AssetBundle
{
    /**
     * @inheritdoc
     */
    //public $sourcePath = '@vendor/bower/admin-lte/dist';
    public $sourcePath = '@backend/web/plugins/admin-lte';

    /**
     * @inheritdoc
     */
    public $css = [
        'css/AdminLTE.min.css',
    ];

    public $js = [
        'js/app.min.js',
        'js/demo.js',
    ];

    /**
     * @inheritdoc
     */
    public $depends = [
        'backend\themes\adminlte\assets\FontAwesomeAsset',
        'yii\web\YiiAsset',
        'yii\web\JqueryAsset',
        'yii\bootstrap\BootstrapAsset',
        'yii\bootstrap\BootstrapPluginAsset'
    ];

    /**
     * @var string|bool Choose skin color, eg. `'skin-blue'` or set `false` to disable skin loading
     * @see https://almsaeedstudio.com/themes/AdminLTE/documentation/index.html#layout
     */
    public $skin = '_all-skins';

    /**
     * @var array
     */
    private static $listSkins = [
        'skin-blue',
        'skin-black',
        'skin-red',
        'skin-yellow',
        'skin-purple',
        'skin-green',
        'skin-blue-light',
        'skin-black-light',
        'skin-red-light',
        'skin-yellow-light',
        'skin-purple-light',
        'skin-green-light'
    ];

    /**
     * @throws Exception
     */
    public function init()
    {
        // Append skin color file if specified
        if ($this->skin) {
            if (('_all-skins' !== $this->skin) && (strpos($this->skin, 'skin-') !== 0)) {
                throw new Exception('Invalid skin specified');
            }
            $this->css[] = sprintf('css/skins/%s.min.css', $this->skin);
        }

        parent::init();
    }

    /**
     * @return string
     */
    public function getPublishedUrl()
    {
        return Yii::$app->assetManager->getPublishedUrl($this->sourcePath);
    }
}
