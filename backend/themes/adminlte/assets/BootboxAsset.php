<?php

namespace backend\themes\adminlte\assets;

use Yii;
use yii\web\AssetBundle;

/**
 * Class BootboxAsset
 * @package backend\themes\adminlte\assets
 */
class BootboxAsset extends AssetBundle
{
    public $sourcePath = '@vendor/bower/bootbox.js';

    public $js = [
        'bootbox.js',
    ];

    /**
     * @inheritdoc
     */
    public static function overrideSystemConfirm()
    {
        Yii::$app->view->registerJs('
            yii.confirm = function(message, ok, cancel) {
                bootbox.confirm(message, function(result) {
                    if (result) { !ok || ok(); } else { !cancel || cancel(); }
                });
            }
        ');
    }
}