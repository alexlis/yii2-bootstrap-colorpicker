<?php
/**
* @file ColorPicker.php
*
* @author alexlis - mengzhonghua12@gmail.com
* @version
* @date 2016-06-30
 */
namespace alexlis\colorpicker;

use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\helpers\Json;
use yii\widgets\InputWidget;


/**
 * ColorPicker render color picker input
 */
class ColorPicker extends InputWidget
{
    public $clientOptions = [];

    public $containerOptions = [];

    public $template = "{input}{reset}{button}";

    public $resetButtonIcon = 'glyphicon glyphicon-remove';

    public $pickButtonIcon = 'glyphicon glyphicon-th';


    public function init()
    {
        parent::init();
        Html::addCssClass($this->containerOptions, 'input-group colorpicker');
        Html::addCssClass($this->options, 'form-control');
        $this->options['readonly'] = 'readonly';


    }

    /**
     * @inheritdoc
     */
    public function run()
    {

        $input = $this->hasModel()
            ? Html::activeTextInput($this->model, $this->attribute, $this->options)
            : Html::textInput($this->name, $this->value, $this->options);

        if (!$this->inline) {
            $resetIcon = Html::tag('span', '', ['class' => $this->resetButtonIcon]);
            $pickIcon = Html::tag('span', '', ['class' => $this->pickButtonIcon]);
            $resetAddon = Html::tag('span', $resetIcon, ['class' => 'input-group-addon']);
            $pickerAddon = Html::tag('span', $pickIcon, ['class' => 'input-group-addon']);
        } else {
            $resetAddon = $pickerAddon = '';
        }

        if (strpos($this->template, '{button}') !== false) {
            $input = Html::tag(
                'div',
                strtr($this->template, ['{input}' => $input, '{reset}' => $resetAddon, '{button}' => $pickerAddon]),
                $this->containerOptions
            );
        }
        echo $input;
        $this->registerClientScript();
    }

    /**
     * Registers required script for the plugin to work as a DateTimePicker
     */
    public function registerClientScript()
    {
        $js = [];
        $view = $this->getView();

        ColorPickerAsset::register($view);
        // @codeCoverageIgnoreEnd

        $id = $this->options['id'];
        $selector = ";jQuery('#$id')";

        if (strpos($this->template, '{button}') !== false || $this->inline) {
            $selector .= ".parent()";
        }

        $options = !empty($this->clientOptions) ? Json::encode($this->clientOptions) : '';

        $js[] = "$selector.colorpicker($options);";

        $view->registerJs(implode("\n", $js));
    }
}
