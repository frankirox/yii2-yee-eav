<?php

namespace yeesoft\eav\assets;

use yii\web\AssetBundle;

class EavAsset extends AssetBundle
{
    public $sourcePath = '@vendor/yeesoft/yii2-yee-eav/assets/source';
    public $css = [
        'css/eav.css',
    ];
    public $js = [
        'js/eav.js',
    ];
    public $depends = [
        'yii\bootstrap\BootstrapAsset',
        'yii\web\JqueryAsset',
        'yii\jui\JuiAsset',
    ];
}
