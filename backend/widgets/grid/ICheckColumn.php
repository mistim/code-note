<?php

namespace backend\widgets\grid;

use Yii;
use yii\base\InvalidConfigException;
use yii\helpers\Html;
use Closure;
use yii\helpers\Json;

class ICheckColumn extends \yii\grid\DataColumn
{
    public $attribute;
    public $modelName;
    public $route;
    public $checkboxOptions = [
        'data-container' => 'body',
        'data-toggle'    => 'popover',
        'data-placement' => 'top',
        'data-content'   => '',
        'class'          => 'icheckbox icheckbox-status',
    ];
    public $cssClass;
    public $format = 'raw';
    public $color = 'green';
    public $type = 'square';

    public function init()
    {
        parent::init();

        if (empty($this->attribute)) {
            throw new InvalidConfigException('The "attribute" property must be set.');
        }

        if (empty($this->modelName)) {
            throw new InvalidConfigException('The "modelName" property must be set.');
        }

        if (empty($this->route)) {
            throw new InvalidConfigException('The "route" property must be set.');
        }

        $this->filter = [
            Yii::t('admin', 'Deactivate'),
            Yii::t('admin', 'Activate'),
        ];

        $this->registerClientScript();
    }

    protected function renderDataCellContent($model, $key, $index)
    {
        $this->header = $model->getAttributeLabel($this->attribute);

        if ($this->checkboxOptions instanceof Closure) {
            $options = call_user_func($this->checkboxOptions, $model, $key, $index, $this);
        } else {
            $options = $this->checkboxOptions;
        }

        if (!isset($options['value'])) {
            $options['value'] = is_array($key) ? Json::encode($key) : $key;
        }

        if ($this->cssClass !== null) {
            Html::addCssClass($options, $this->cssClass);
        }

        return Html::checkbox($this->attribute, $model->{$this->attribute}, $options);
    }

    public function registerClientScript()
    {
        $view = $this->grid->getView();
        $view->registerJsFile('@web/plugins/admin-lte/plugins/iCheck/icheck.js', ['depends' => 'yii\web\JqueryAsset']);
        $view->registerCssFile('@web/plugins/admin-lte/plugins/iCheck/' . $this->type . '/' . $this->color . '.css');

        $checkboxOptionsClass = str_replace(' ', '.', $this->checkboxOptions['class']);

        $js = "
            $('.icheckbox')
            .iCheck({
                checkboxClass: 'icheckbox_{$this->type}-{$this->color}',
                radioClass: 'iradio_{$this->type}-{$this->color}',
                increaseArea: '20%' // optional
            })
            .on('ifChecked', function() {
                changeStatus($(this).parents('tr').data('key'), 1)
            })
            .on('ifUnchecked', function() {
                changeStatus($(this).parents('tr').data('key'), 0)
            });
        
            function changeStatus(id, status) {
                $.ajax({
                    type: 'POST',
                    dataType : 'JSON',
                    url: '{$this->route}?id=' +  id,
                    data: {
                        '{$this->modelName}[{$this->attribute}]': status
                    },
                    success: function(data) {
                        var popoverBlock = $('tr[data-key=\"' + id + '\"]').find('.{$checkboxOptionsClass}');
                        
                        popoverBlock.data('content', data.message).popover('show');
                        
                        setTimeout(function() {
                            popoverBlock.popover('hide');
                        }, 1000);
                    },
                    error: function() {
                        
                    }
                });
            }
        ";

        $view->registerJs($js, $view::POS_END);
    }
}