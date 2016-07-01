<?php
/**
* @file ColorPickerAsset.php
*
* @author mengzhonghua - mengzhonghua12@gmail.com
* @version
* @date 2016-06-30
 */

namespace alexlis;

use yii\web\AssetBundle;

class ColorPickerAsset extends AssetBundle
{
    public $sourcePath = '@vendor/mjolnic/bootstrap-colorpicker/dist';

    public $depends = [
        'yii\bootstrap\BootstrapPluginAsset'
    ];

    public function init()
    {
         $this->css[] = YII_DEBUG ? 'css/bootstrap-colorpicker.css' : 'css/bootstrap-colorpicker.min.css';
         $this->js[] = YII_DEBUG ? 'js/bootstrap-colorpicker.js' : 'js/bootstrap-colorpicker.min.js';
    }
}
