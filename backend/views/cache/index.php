<?php

use yii\bootstrap\ActiveForm;
use yii\bootstrap\Html;
use yii\grid\GridView;
use yii\helpers\ArrayHelper;
use yii\helpers\Url;

/* @var $this yii\web\View */

$this->title = Yii::t('backend', 'Cache');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="article-index">

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            'name',
            'class',
            [
                'class' => 'yii\grid\ActionColumn',
                'template' => '{flush-cache}',
                'buttons' => [
                    'flush-cache' => function ($url, $model) {
                        return Html::a('<i class="fa fa-refresh"></i>', $url, [
                            'title' => Yii::t('backend', 'Flush'),
                            'data-confirm' => Yii::t('backend', 'Are you sure you want to flush this cache?'),
                        ]);
                    },
                ],
            ],
        ],
    ]) ?>

    <div class="row">
        <div class="col-xs-6">
            <h4><?= Yii::t('backend', 'Delete a value with the specified key from cache') ?></h4>
            <?php ActiveForm::begin([
                'action' => Url::to('flush-cache-key'),
                'method' => 'get',
                'layout' => 'inline',
            ]) ?>
                <?= Html::dropDownList(
                    'id', null, ArrayHelper::map($dataProvider->allModels, 'name', 'name'),
                    ['class' => 'form-control', 'prompt' => Yii::t('backend', 'Select cache')])
                ?>
                <?= Html::input('string', 'key', null, ['class' => 'form-control', 'placeholder' => Yii::t('backend', 'Key')]) ?>
                <?= Html::submitButton(Yii::t('backend', 'Flush'), ['class' => 'btn btn-danger']) ?>
            <?php ActiveForm::end() ?>
        </div>
        <div class="col-xs-6">
            <h4><?= Yii::t('backend', 'Invalidate tag') ?></h4>
            <?php ActiveForm::begin([
                'action' => Url::to('flush-cache-tag'),
                'method' => 'get',
                'layout' => 'inline',
            ]) ?>
                <?= Html::dropDownList(
                    'id', null, ArrayHelper::map($dataProvider->allModels, 'name', 'name'),
                    ['class' => 'form-control', 'prompt' => Yii::t('backend', 'Select cache')]) ?>
                <?= Html::input('string', 'tag', null, ['class' => 'form-control', 'placeholder' => Yii::t('backend', 'Tag')]) ?>
                <?= Html::submitButton(Yii::t('backend', 'Flush'), ['class' => 'btn btn-danger']) ?>
            <?php ActiveForm::end() ?>
        </div>
    </div>

</div>
