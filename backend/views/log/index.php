<?php

use yii\bootstrap\Html;
use yii\grid\GridView;
use yii\log\Logger;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\search\LogSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('backend', 'Logs');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="log-index">

    <p>
        <?= Html::a(Yii::t('backend', 'Clear'), false, ['class' => 'btn btn-danger', 'data-method' => 'delete']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            //['class' => 'yii\grid\SerialColumn'],

            // 'id',
            [
                'attribute' => 'level',
                'value' => function ($model) {
                    return Logger::getLevelName($model->level);
                },
                'filter' => [
                    Logger::LEVEL_ERROR => 'error',
                    Logger::LEVEL_WARNING => 'warning',
                    Logger::LEVEL_INFO => 'info',
                    Logger::LEVEL_TRACE => 'trace',
                    Logger::LEVEL_PROFILE_BEGIN => 'profile begin',
                    Logger::LEVEL_PROFILE_END => 'profile end',
                ],
            ],
            'category',
            [
                'attribute' => 'log_time',
                'format' => 'datetime',
                'value' => function ($model) {
                    return (int) $model->log_time;
                },
            ],
            'prefix',

            [
                'class' => 'yii\grid\ActionColumn',
                'template' => '{view} {delete}',
            ],

        ],
    ]) ?>

</div>
