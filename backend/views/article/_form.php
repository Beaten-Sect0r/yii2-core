<?php

use yii\bootstrap\ActiveForm;
use yii\bootstrap\Html;
use yii\helpers\ArrayHelper;
use yii\helpers\Url;
use backend\widgets\TinyMCECallback;
use bs\Flatpickr\FlatpickrWidget;
use dosamigos\selectize\SelectizeTextInput;
use dosamigos\tinymce\TinyMce;

/* @var $this yii\web\View */
/* @var $model common\models\Article */
/* @var $form yii\bootstrap\ActiveForm */
?>

<div class="article-form">

    <?php $form = ActiveForm::begin() ?>

    <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'slug')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'description')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'keywords')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'preview')->widget(TinyMce::class, [
        'language' => strtolower(substr(Yii::$app->language, 0, 2)),
        'clientOptions' => [
            'height'=> 150,
            'plugins' => [
                'advlist autolink lists link image charmap print preview anchor pagebreak',
                'searchreplace visualblocks code fullscreen',
                'insertdatetime media table contextmenu paste code textcolor colorpicker',
            ],
            'toolbar' => 'undo redo | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image media | forecolor backcolor',
            'file_picker_callback' => TinyMCECallback::getFilePickerCallback(['file-manager/frame']),
        ],
    ]) ?>

    <?= $form->field($model, 'body')->widget(TinyMce::class, [
        'language' => strtolower(substr(Yii::$app->language, 0, 2)),
        'clientOptions' => [
            'height'=> 350,
            'plugins' => [
                'advlist autolink lists link image charmap print preview anchor pagebreak',
                'searchreplace visualblocks code fullscreen',
                'insertdatetime media table contextmenu paste code textcolor colorpicker',
            ],
            'toolbar' => 'undo redo | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image media | forecolor backcolor',
            'file_picker_callback' => TinyMCECallback::getFilePickerCallback(['file-manager/frame']),
        ],
    ]) ?>

    <?= $form->field($model, 'tagValues')->widget(SelectizeTextInput::class, [
        'loadUrl' => ['tag/list'],
        'options' => ['class' => 'form-control'],
        'clientOptions' => [
            'plugins' => ['remove_button'],
            'valueField' => 'name',
            'labelField' => 'name',
            'searchField' => ['name'],
            'create' => true,
        ],
    ]) ?>

    <?= $form->field($model, 'status')->checkbox(['label' => Yii::t('backend', 'Activate')]) ?>

    <?= $form->field($model, 'category_id')->dropDownList(ArrayHelper::map(
            $categories,
            'id',
            'title'
        ), ['prompt' => '']
    ) ?>

    <?= $form->field($model, 'published_at')->widget(FlatpickrWidget::class, [
        'locale' => strtolower(substr(Yii::$app->language, 0, 2)),
        'plugins' => [
             'confirmDate' => [
                   'confirmIcon'=> "<i class='fa fa-check'></i>",
                   'confirmText' => 'OK',
                   'showAlways' => false,
                   'theme' => 'light',
             ],
        ],
        'groupBtnShow' => true,
        'options' => [
            'class' => 'form-control',
        ],
        'clientOptions' => [
            'allowInput' => true,
            'defaultDate' => $model->published_at ? date(DATE_ATOM, $model->published_at) : null,
            'enableTime' => true,
            'time_24hr' => true,
        ],
    ]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('backend', 'Create') : Yii::t('backend', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end() ?>

</div>
