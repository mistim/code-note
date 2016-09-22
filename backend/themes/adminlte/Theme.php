<?php

namespace backend\themes\adminlte;

use Yii;

/**
 * Class Theme
 * @package backend\themes\adminlte
 */
class Theme extends \yii\base\Theme
{
    /**
     * @inheritdoc
     */
    /*public $pathMap = [
        '@backend/views' => '@backend/themes/site/views',
        '@backend/modules' => '@backend/themes/site/modules'
    ];*/

    /**
     * @inheritdoc
     */
    public function init()
    {
        parent::init();

        /*Yii::$container->set('yii\grid\CheckboxColumn', [
            'checkboxOptions' => [
                'class' => 'simple'
            ]
        ]);*/
    }
}
