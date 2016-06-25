<?php

use yii\bootstrap\Html;
use yii\grid\GridView;
use yii\helpers\ArrayHelper;
use common\models\Menu;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\search\MenuSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('backend', 'Menu');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="menu-index">

    <p>
        <?= Html::a(Yii::t('backend', 'Create item'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            //['class' => 'yii\grid\SerialColumn'],

            // 'id',
            // 'url',
            'label',
            [
                'attribute' => 'parent_id',
                'value' => function ($model) {
                    return $model->parent ? $model->parent->label : null;
                },
                'filter' => ArrayHelper::map(Menu::find()->noParents()->all(), 'id', 'label'),
            ],
            [
                'attribute' => 'status',
                'format' => 'html',
                'value' => function ($model) {
                    return $model->status ? '<span class="glyphicon glyphicon-ok text-success"></span>' : '<span class="glyphicon glyphicon-remove text-danger"></span>';
                },
                'filter' => [
                    Menu::STATUS_DRAFT => Yii::t('backend', 'Not active'),
                    Menu::STATUS_ACTIVE => Yii::t('backend', 'Active'),
                ],
            ],
            'sort_index',

            [
                'class' => 'yii\grid\ActionColumn',
                'template' => '{update} {delete}',
            ],
        ],
    ]) ?>

</div>
