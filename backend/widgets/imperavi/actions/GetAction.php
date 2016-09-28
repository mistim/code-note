<?php

namespace backend\widgets\imperavi\actions;

use Yii;
use yii\base\Action;
use yii\base\InvalidCallException;
use yii\base\InvalidConfigException;
use yii\web\Response;
use backend\widgets\imperavi\helpers\FileHelper;

/**
 * Class GetAction
 * @package backend\widgets\imperavi\actions
 */
class GetAction extends Action
{
    /** Image type */
    const TYPE_IMAGES = 0;
    /** File type */
    const TYPE_FILES = 1;

    /**
     * @var string Files directory
     */
    public $path;

    /**
     * @var string Files directory URL
     */
    public $url;

    /**
     * [\backend\widgets\imperavi\helpers\FileHelper::findFiles()|FileHelper::findFiles()] options argument.
     * @var array Options
     */
    public $options = [];

    /**
     * @var int return type (images or files)
     */
    public $type = self::TYPE_IMAGES;

    /**
     * @inheritdoc
     */
    public function init()
    {
        if ($this->url === null) {
            throw new InvalidConfigException('The "url" attribute must be set.');
        } else {
            $this->options['url'] = Yii::getAlias($this->url);
        }
        if ($this->path === null) {
            throw new InvalidConfigException('The "path" attribute must be set.');
        } else {
            $this->path = FileHelper::normalizePath(Yii::getAlias($this->path));
        }
    }

    /**
     * @inheritdoc
     */
    public function run()
    {
        Yii::$app->response->format = Response::FORMAT_JSON;
        return FileHelper::findFiles($this->path, $this->options, $this->type);
    }
}
