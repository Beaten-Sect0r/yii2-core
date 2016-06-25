<?php

use yii\bootstrap\Html;
use yii\grid\GridView;
use yii\helpers\ArrayHelper;
use common\models\Article;
use common\models\ArticleCategory;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\search\ArticleSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('backend', 'Articles');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="article-index">

    <p>
        <?= Html::a(Yii::t('backend', 'Create article'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            //['class' => 'yii\grid\SerialColumn'],

            'id',
            'title',
            // 'slug',
            // 'description',
            // 'keywords',
            // 'body:ntext',
            [
                'attribute' => 'status',
                'format' => 'html',
                'value' => function ($model) {
                    return $model->status ? '<span class="glyphicon glyphicon-ok text-success"></span>' : '<span class="glyphicon glyphicon-remove text-danger"></span>';
                },
                'filter' => [
                    Article::STATUS_DRAFT => Yii::t('backend', 'Not active'),
                    Article::STATUS_ACTIVE => Yii::t('backend', 'Active'),
                ],
            ],
            [
                'attribute' => 'category_id',
                'value' => function ($model) {
                    return $model->category ? $model->category->title : null;
                },
                'filter' => ArrayHelper::map(ArticleCategory::find()->all(), 'id', 'title'),
            ],
            [
                'attribute' => 'author_id',
                'value' => function ($model) {
                    return $model->author->username;
                },
            ],
            // 'updater_id',
            // 'published_at',
            // 'created_at',
            // 'updated_at'

            [
                'class' => 'yii\grid\ActionColumn',
                'template' => '{update} {delete}',
            ],
        ],
    ]) ?>

</div>
