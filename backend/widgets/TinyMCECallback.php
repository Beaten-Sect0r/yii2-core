<?php

namespace backend\widgets;

use Yii;
use yii\helpers\ArrayHelper;
use yii\helpers\Json;
use yii\helpers\Url;
use yii\web\JsExpression;

class TinyMCECallback
{
    /**
     * Callback for TinyMCE 4 file_picker_callback
     *
     * @param array|string $url Url to TinyMCEAction
     * @param array $popupSettings TinyMCE popup settings
     * @return JsExpression
     */
    public static function getFilePickerCallback($url, $popupSettings = [])
    {
        $default = [
            'title' => Yii::t('backend', 'File manager'),
            'width' => 900,
            'height' => 450,
            'resizable' => true,
        ];

        $settings = ArrayHelper::merge($default, $popupSettings);
        $settings['file'] = Url::to($url);
        $settings = Json::encode($settings);

        $callback = <<<JS
            function(callback, value, meta) {
                tinymce.activeEditor.windowManager.open($settings, {
                    oninsert: function(file, fm) {
                        var url, reg, info;

                        // URL normalization
                        url = file.url;
                        reg = /\/[^/]+?\/\.\.\//;
                        while (url.match(reg)) {
                            url = url.replace(reg, '/');
                        }

                        // Make file info
                        info = file.name + ' (' + fm.formatSize(file.size) + ')';

                        // Provide file and text for the link dialog
                        if (meta.filetype == 'file') {
                            callback(url, {
                                text: info,
                                title: info
                            });
                        }

                        // Provide image and alt text for the image dialog
                        if (meta.filetype == 'image') {
                            callback(url, {
                                alt: info
                            });
                        }

                        // Provide alternative source and posted for the media dialog
                        if (meta.filetype == 'media') {
                            callback(url);
                        }
                    }
                });
                return false;
            }
JS;

        return new JsExpression($callback);
    }
}
