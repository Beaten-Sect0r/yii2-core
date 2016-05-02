<?php

namespace common\assets;

use yii\web\AssetBundle;

class Html5shiv extends AssetBundle
{
    public $sourcePath = '@bower/html5shiv/dist';
    public $js = [
        'html5shiv.min.js',
    ];
    public $jsOptions = [
        'condition' => 'lt IE 9',
    ];
}
