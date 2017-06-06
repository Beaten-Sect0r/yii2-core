<?php

use yii\helpers\Json;
use yii\helpers\Url;
use yii\web\JqueryAsset;
use yii\web\JsExpression;
use yii\web\View;
use mihaildev\elfinder\Assets;

/* @var $this yii\web\View */

JqueryAsset::register($this);
Assets::register($this);
$lang = strtolower(substr(Yii::$app->language, 0, 2));
Assets::addLangFile($lang, $this);

$options = [
    'url' => Url::toRoute('/elfinder/connect'),
    'customData' => [
        Yii::$app->request->csrfParam => Yii::$app->request->csrfToken,
    ],
    'resizable' => false,
    'lang' => $lang,
    'soundPath' => Assets::getSoundPathUrl(),
];

$callback = <<<JS
    function (file, fm) {
        // pass selected file data to TinyMCE
        parent.tinymce.activeEditor.windowManager.getParams().oninsert(file, fm);
        // close popup window
        parent.tinymce.activeEditor.windowManager.close();
    }
JS;
$options['getFileCallback'] = new JsExpression($callback);

$options = Json::encode($options);

$script = <<<JS
if (top === self) window.location = "/";

jQuery('#elfinder').elfinder($options).elfinder('instance');
JS;
$this->registerJs($script, View::POS_READY);
?>
<div id="elfinder"></div>
