<?php

namespace backend\widgets\fileapi\actions;

use yii\base\Action;
use yii\base\InvalidConfigException;
use yii\base\InvalidParamException;
use yii\helpers\FileHelper;
use Yii;
use yii\web\BadRequestHttpException;
use yii\web\Response;

/**
 * DeleteDocumentAction for images and files.
 *
 * Usage:
 * ```php
 * public function actions()
 * {
 *     return [
 *         'delete-file' => [
 *             'class' => 'backend\widgets\fileapi\actions\SeleteDocumentAction',
 *             'path' => '@path/to/files'
 *         ]
 *     ];
 * }
 * ```
 */
class DeleteDocumentAction extends Action
{
    /**
     * @var string Path to directory where files has been uploaded
     */
    public $path;

    /**
     * @var string Variable's name that FileAPI sent upon image/file upload.
     */
    public $uploadParam = 'file';

    public $subDir;
    public $callback = [];

    /**
     * @throws InvalidConfigException
     */
    public function init()
    {
        $this->subDir = Yii::$app->request->post('subdir', null);

        if (!$this->subDir)
        {
            throw new InvalidParamException('Unknown option "subDir"');
        }

        if ($this->path === null)
        {
            throw new InvalidConfigException("Empty \"{$this->path}\".");
        }
        else
        {
            $this->path = FileHelper::normalizePath($this->path) . DIRECTORY_SEPARATOR . FileHelper::normalizePath($this->subDir) . DIRECTORY_SEPARATOR;
        }
    }

    /**
     * @return array
     * @throws BadRequestHttpException
     */
    public function run()
    {
        if (Yii::$app->request->isAjax)
        {
            $file = Yii::$app->request->post('file', null);
            Yii::$app->response->format = Response::FORMAT_JSON;

            if ($file && is_file($this->path . $file))
            {
                if (unlink($this->path . $file) && $this->runCallback($file))
                {
                    return ['success' => Yii::t('admin', 'File successfully removed')];
                }
                else
                {
                    return ['error' => Yii::t('admin', 'File not removed')];
                }
            }
            else
            {
                return ['error' => Yii::t('admin', 'File not found' . $this->path . $file)];
            }
        }
        else
        {
            throw new BadRequestHttpException('Only AJAX is allowed');
        }
    }

    /**
     * @param $file
     * @return bool
     */
    protected function runCallback($file)
    {
        if (!empty($this->callback) && is_array($this->callback))
        {
            $className = array_key_exists('class', $this->callback) ? $this->callback['class'] : null;
            $classAction = array_key_exists('action', $this->callback) ? $this->callback['action'] : null;;
        }

        if ($className && $classAction)
        {
            $orderID = Yii::$app->request->post('orderID', null);
            $documentID = Yii::$app->request->post('documentID', null);

            return $className::$classAction($orderID, $documentID, $file);
        }

        return true;
    }
}