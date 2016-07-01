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

    public $template = "{input}{button}";

    private $id = '';


    public function init()
    {
        parent::init();
        Html::addCssClass($this->containerOptions, 'input-group colorpicker-component');
        Html::addCssClass($this->options, 'form-control');
        $this->id =$this->options['id'];
        $this->containerOptions['id'] = $this->id;
        $this->options['readonly'] = 'readonly';
        unset($this->options['id']);
    }

    /**
     * @inheritdoc
     */
    public function run()
    {

        $input = $this->hasModel()
            ? Html::activeTextInput($this->model, $this->attribute, $this->options)
            : Html::textInput($this->name, $this->value, $this->options);

        $pickerAddon = Html::tag('span', '<i></i>', ['class' => 'input-group-addon']);

        if (strpos($this->template, '{button}') !== false) {
            $input = Html::tag(
                'div',
                strtr($this->template, ['{input}' => $input, '{button}' => $pickerAddon]),
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

        $id = $this->id;
        $selector = ";jQuery('#$id')";

        $options = !empty($this->clientOptions) ? Json::encode($this->clientOptions) : '';

        $js[] = "$selector.colorpicker($options);";

        $view->registerJs(implode("\n", $js));
    }
}
