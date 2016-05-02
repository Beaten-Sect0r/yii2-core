<?php

namespace frontend\controllers;

use Yii;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use common\models\Page;

/**
 * Class PageController.
 */
class PageController extends Controller
{
    /**
     * Displays a single Page model.
     *
     * @param $slug
     * @return mixed
     */
    public function actionView($slug)
    {
        $model = Page::find()->where(['slug' => $slug, 'status' => Page::STATUS_ACTIVE])->one();
        if (!$model) {
            throw new NotFoundHttpException(Yii::t('frontend', 'Page not found.'));
        }

        // meta keywords
        $this->getView()->registerMetaTag([
            'name' => 'description',
            'content' => $model->description,
        ]);
        // meta description
        $this->getView()->registerMetaTag([
            'name' => 'keywords',
            'content' => $model->keywords,
        ]);

        return $this->render('view', ['model' => $model]);
    }
}
