<?php

namespace common\assets;

use yii\web\AssetBundle;

class TimeCircles extends AssetBundle
{
    public $sourcePath = '@bower/timecircles/inc';
    public $js = [
        'TimeCircles.js',
    ];
    public $css = [
        'TimeCircles.css',
    ];
    public $depends = [
        'yii\web\JqueryAsset',
    ];
}
