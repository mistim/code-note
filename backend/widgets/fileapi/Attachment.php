<?php

namespace backend\widgets\fileapi;

use yii\helpers\ArrayHelper;
use yii\helpers\Url;
use yii\helpers\Html;
use yii\helpers\Json;
use yii\web\JsExpression;
use yii\widgets\InputWidget;
use Yii;

class Attachment extends InputWidget
{
    /**
     * @var string FileAPI selector
     */
    public $selector;

    /**
     * Widget settings.
     *
     * @var array {@link https://github.com/RubaXa/jquery.fileapi/ FileAPI options}
     */
    public $settings = [];

    /**
     * @var boolean Enable/disable files preview
     */
    public $preview = true;

    /**
     * @var array FileAPI events array
     */
    public $callbacks = [];

    public $csrf;

    public $data = [];



    public function init()
    {
        parent::init();

        $request = Yii::$app->getRequest();

        if ($request->enableCsrfValidation === true) {
            $this->settings['data'][$request->csrfParam] = $this->csrf = $request->getCsrfToken();
        }

    }

    public function run()
    {
        //$this->registerFiles();
        $this->register();

        echo Html::fileInput($this->name, $this->value, $this->options);
        //echo Html::hiddenInput($this->name, $this->value, $this->options);
    }

    /**
     * @return string Widget selector
     */
    public function getSelector()
    {
        return $this->selector !== null ? $this->selector : $this->options['id'];
    }

    /**
     * Register all widget scripts and callbacks
     */
    public function register()
    {
        $this->registerMainClientScript();
        $this->registerClientScript();
        //$this->registerDefaultCallbacks();
        //$this->registerCallbacks();
    }

    /**
     * Register widget asset.
     */
    public function registerClientScript()
    {
        $view = $this->getView();
        $selector = $this->getSelector();
        $data = json_encode($this->data);

        if ($this->preview === true) {
            $view->registerJs(
                "jQuery(document).ready(function() {
                    var inputsFile = $('.$selector');
                    inputsFile.each(function() {
                        var fileInput = this;
                        FileAPI.event.on(fileInput, 'change', function (evt){
                            //var files = FileAPI.getFiles(evt); // Retrieve file list
                            var files = FileAPI.getFiles(fileInput); // Retrieve file list
                            var data = $(fileInput).data('params');
                            data._csrf = '$this->csrf';

                            if(files.length) {
                                // Uploading Files
                                FileAPI.upload({
                                    dataType: 'json',
                                    method: 'post',
                                    url: '{$this->settings['url']['upload']}',
                                    files: { file: files },
                                    data: data,
                                    progress: function (evt){  },
                                    complete: function (err, xhr){
                                        $(fileInput).val('');
                                        var data = JSON.parse(xhr.responseText);
                                        var parents = $(fileInput).parents('.files-container-parent');

                                        if (data.hasOwnProperty('error')) {
                                            parents.addClass('has-error');
                                            parents.find('.help-block').html(data.error);
                                        } else
                                        if (data.hasOwnProperty('name')) {
                                            parents.find('.help-block').html(data.success);
                                            parents.removeClass('has-error');
                                            parents.find('.files').append('<div class=\"file-name\"><span class=\"file-item\">' + data.name + '</span> <span class=\"remove-btn\"></span></div>');
                                        }
                                    }
                                });
                            }
                        });
                    });

                    $('.files-block-item').on('click', '.remove-btn', function(e) {
                        e.preventDefault();
                        var parents = $(this).parents('.files-container-parent');
                        var parent = $(this).parent('.file-name');
                        var data = parents.find('.$selector').data('params');
                        data._csrf = '$this->csrf';
                        data.file = $(this).parents('.file-name').find('.file-item').html();

                        $.ajax({
                            dataType: 'json',
                            method: 'post',
                            url: '{$this->settings['url']['delete']}',
                            data: data,
                            success: function (data) {
                                if (data.hasOwnProperty('error')) {
                                    parents.addClass('has-error');
                                    parents.find('.help-block').html(data.error);
                                } else
                                if (data.hasOwnProperty('success')) {
                                    parents.find('.help-block').html('');
                                    parent.remove();
                                    parents.find('.help-block').html(data.success);
                                }
                            }
                        });
                    });
                });"
            );
        }
    }

    /**
     * Register widget main asset.
     */
    protected function registerMainClientScript()
    {
        $selector = $this->getSelector();
        $options = Json::encode($this->settings);
        $view = $this->getView();

        AttachmentAsset::register($view);

        //$view->registerJs("jQuery(document).ready(function() { jQuery('#$selector').fileapi($options); });");
    }

    /**
     * Register default widget callbacks
     */
    protected function registerDefaultCallbacks()
    {
        // File complete handler
        $this->callbacks['filecomplete'][] = new JsExpression('function (evt, uiEvt) {' .
            'if (uiEvt.result.error) {' .
                'alert(uiEvt.result.error);' .
            '} else {' .
                'jQuery(this).find("input[type=\"hidden\"]").val(uiEvt.result.name);' .
                'jQuery(this).find("[data-fileapi=\"browse-text\"]").addClass("hidden");' .
                'jQuery(this).find("[data-fileapi=\"delete\"]").attr("data-fileapi-uid", FileAPI.uid(uiEvt.file));' .
            '}' .
        '}');
    }

    /**
     * Register widget callbacks.
     */
    protected function registerCallbacks()
    {
        if (!empty($this->callbacks)) {
            $selector = $this->getSelector();
            $view = $this->getView();
            foreach ($this->callbacks as $event => $callback) {
                if (is_array($callback)) {
                    foreach ($callback as $function) {
                        if (!$function instanceof JsExpression) {
                            $function = new JsExpression($function);
                        }
                        $view->registerJs("jQuery('#$selector').on('$event', $function);");
                    }
                } else {
                    if (!$callback instanceof JsExpression) {
                        $callback = new JsExpression($callback);
                    }
                    $view->registerJs("jQuery('#$selector').on('$event', $callback);");
                }
            }
        }
    }
}