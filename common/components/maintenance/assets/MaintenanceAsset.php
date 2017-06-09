<?php

namespace common\components\maintenance\assets;

use yii\web\AssetBundle;

class MaintenanceAsset extends AssetBundle
{
    public $sourcePath = '@common/components/maintenance/assets';
    public $js = [
        'js/maintenance.js',
    ];
    public $css = [
        'css/maintenance.css',
    ];
    public $depends = [
        'common\assets\TimeCircles',
        'common\assets\OpenSans',
    ];
}
