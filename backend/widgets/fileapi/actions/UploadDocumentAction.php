<?php

namespace backend\widgets\fileapi\actions;

use yii\base\Action;
use yii\base\DynamicModel;
use yii\base\InvalidCallException;
use yii\base\InvalidConfigException;
use yii\base\InvalidParamException;
use yii\helpers\FileHelper;
use yii\web\BadRequestHttpException;
use yii\web\Response;
use yii\web\UploadedFile;
use Yii;

class UploadDocumentAction extends Action
{
    public $subDir;

    /**
     * @var string Path to directory where files will be uploaded
     */
    public $path;

    /**
     * @var string Validator name
     */
    public $uploadOnlyImage = false;

    /**
     * @var string The parameter name for the file form data (the request argument name).
     */
    public $paramName = 'file';

    /**
     * @var boolean If `true` unique filename will be generated automatically
     */
    public $unique = true;

    /**
     * @var array Model validator options
     */
    public $validatorOptions = [];

    /**
     * @var string Model validator name
     */
    private $_validator = 'image';

    public $callback = [];

    /**
     * @inheritdoc
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
            throw new InvalidConfigException('The "path" attribute must be set.');
        }
        else
        {
            $this->path = FileHelper::normalizePath(Yii::getAlias($this->path)) . DIRECTORY_SEPARATOR . FileHelper::normalizePath($this->subDir) . DIRECTORY_SEPARATOR;

            if (!FileHelper::createDirectory($this->path))
            {
                throw new InvalidCallException('Directory specified in "path" attribute doesn\'t exist or cannot be created.');
            }
        }

        if ($this->uploadOnlyImage !== true)
        {
            $this->_validator = 'file';
            $this->validatorOptions = [
                'extensions' => ['png', 'jpg', 'jpeg', 'pdf'],
                'maxSize'    => 1024 * 1024 * 10 // 10MB
            ];
        }
    }

    /**
     * @inheritdoc
     */
    public function run()
    {
        if (Yii::$app->request->isPost)
        {
            $file = UploadedFile::getInstanceByName($this->paramName);
            $model = new DynamicModel(compact('file'));
            $model->addRule('file', $this->_validator, $this->validatorOptions)->validate();

            if ($model->hasErrors())
            {
                $result = [
                    'error' => $model->getFirstError('file')
                ];
            }
            else
            {
                if ($this->unique === true && $model->file->extension)
                {
                    $model->file->name = $this->prepareIfExist($model);
                }

                if ($model->file->saveAs($this->path . $model->file->name) && $this->runCallback($model->file->name))
                {
                    $result = [
                        'name' => $model->file->name,
                        'success' => Yii::t('admin', 'File successfully uploaded')
                    ];
                }
                else
                {
                    $result = ['error' => Yii::t('admin', 'ERROR_CAN_NOT_UPLOAD_FILE')];
                }
            }

            Yii::$app->response->format = Response::FORMAT_JSON;

            return $result;
        }
        else
        {
            throw new BadRequestHttpException('Only POST is allowed');
        }
    }

    /**
     * @param $model
     * @return string
     */
    protected function prepareIfExist($model)
    {
        $fileName = str_replace('.' . $model->file->extension, '', $model->file->name);
        $i = 0;

        while (file_exists($this->path . $fileName . '.' . $model->file->extension))
        {
            $fileName = str_replace('.' . $model->file->extension, '', $model->file->name) . '_' . ++$i;
        }

        return $fileName . '.' . $model->file->extension;
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