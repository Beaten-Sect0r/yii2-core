<?php

namespace common\assets;

use yii\web\AssetBundle;

class JquerySlimScroll extends AssetBundle
{
    public $sourcePath = '@bower/jquery-slimscroll';
    public $js = [
        'jquery.slimscroll.min.js',
    ];
    public $depends = [
        'yii\web\JqueryAsset',
    ];
}
