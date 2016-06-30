<?php
/**
* @file ColorPickerAsset.php
*
* @author mengzhonghua - mengzhonghua12@gmail.com
* @version
* @date 2016-06-30
 */

namespace alexlis\colorpicker;

use yii\web\AssetBundle;

class DateTimePickerAsset extends AssetBundle
{
    public $sourcePath = '@vendor/bower/smalot-bootstrap-datetimepicker';

    public $depends = [
        'yii\bootstrap\BootstrapPluginAsset'
    ];

    public function init()
    {
        $this->css[] = YII_DEBUG ? 'css/bootstrap-datetimepicker.css' : 'css/bootstrap-datetimepicker.min.css';
        $this->js[] = YII_DEBUG ? 'js/bootstrap-datetimepicker.js' : 'js/bootstrap-datetimepicker.min.js';
    }
}
