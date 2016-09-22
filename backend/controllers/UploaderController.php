<?php

namespace backend\controllers;

use common\models\TextBlock;
use Yii;
use yii\filters\VerbFilter;
use backend\widgets\imperavi\actions\GetAction;
use backend\widgets\imperavi\actions\UploadAction;

/**
 * Class UploaderController
 * @package backend\controllers
 */
class UploaderController extends BaseController
{
    /**
     * @return array
     */
    /*public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'calculate' => ['post'],
                    'validate'  => ['post'],
                ],
            ],
        ];
    }*/

    public function actions()
    {
        return [
            'image-get'    => [
                'class' => GetAction::className(),
                'path'  => '@statics/web/uploads/images',
                'url'   => '@statics_url/uploads/images/',
                'type'  => GetAction::TYPE_IMAGES,
            ],
            'image-upload'    => [
                'class' => UploadAction::className(),
                'path'  => '@statics/web/uploads/images',
                'url'   => '@statics_url/uploads/images/',
            ],
            'file-get'    => [
                'class' => GetAction::className(),
                'path'  => '@statics/web/uploads/files',
                'url'   => '@statics_url/uploads/files/',
                'type'  => GetAction::TYPE_FILES,
            ],
            'file-upload'    => [
                'class'           => UploadAction::className(),
                'path'            => '@statics/web/uploads/files',
                'url'             => '@statics_url/uploads/files/',
                'uploadOnlyImage' => false,
            ],
        ];
    }
}