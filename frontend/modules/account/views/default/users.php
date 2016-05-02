<?php

use yii\grid\GridView;
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $searchModel frontend\modules\account\models\search\UserSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('frontend', 'Users');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="account-default-users">
    <h1><?= Html::encode($this->title) ?></h1>
    <?= $this->render('_search', ['model' => $searchModel]) ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            [
                'attribute' => 'username',
                'format' => 'html',
                'value' => function ($model) {
                    return Html::a(Html::encode($model['username']), ['view', 'id' => $model['id']]);
                }
            ],
            'created_at:datetime',
            'action_at:datetime',
        ],
        'summary' => false,
    ]) ?>
</div>
