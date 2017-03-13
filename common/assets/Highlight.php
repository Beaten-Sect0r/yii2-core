<?php

namespace common\assets;

use yii\web\AssetBundle;
use yii\web\View;

class Highlight extends AssetBundle
{
    public $sourcePath = '@bower/highlightjs';
    public $js = [
        'highlight.pack.min.js',
    ];
    public $css = [
        'styles/github.css',
    ];
    public $depends = [
        'yii\web\JqueryAsset',
    ];

    public function registerAssetFiles($view)
    {
        parent::registerAssetFiles($view);

        $view->registerJs('hljs.initHighlightingOnLoad();', View::POS_END);
    }
}
