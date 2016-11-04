<?php

namespace frontend\controllers;

use Yii;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use common\models\Article;
use common\models\ArticleCategory;
use common\models\Tag;

/**
 * Class ArticleController.
 */
class ArticleController extends Controller
{
    /**
     * Lists all Article models.
     *
     * @return mixed
     */
    public function actionIndex()
    {
        $query = Article::find()->published()->with('category', 'tags');

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => ['defaultPageSize' => 10],
        ]);

        $dataProvider->sort = [
            'defaultOrder' => ['created_at' => SORT_DESC],
        ];

        return $this->render('index', [
            'dataProvider' => $dataProvider,
            'menuItems' => self::getMenuItems(),
        ]);
    }

    /**
     * Displays a single Article model.
     *
     * @param $slug
     * @return mixed
     */
    public function actionView($slug)
    {
        $model = Article::find()->andWhere(['slug' => $slug])->published()->one();
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

        return $this->render('view', [
            'model' => $model,
            'menuItems' => self::getMenuItems(),
        ]);
    }

    /**
     * Lists all Article models that are category with $slug.
     *
     * @param $slug
     * @return mixed
     */
    public function actionCategory($slug)
    {
        $model = ArticleCategory::find()->andWhere(['slug' => $slug])->active()->one();
        if (!$model) {
            throw new NotFoundHttpException(Yii::t('frontend', 'Page not found.'));
        }

        $query = Article::find()->with('tags')->joinWith('category')->where('{{%article_category}}.slug = :slug', [':slug' => $slug])->published();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => ['defaultPageSize' => 10],
        ]);

        $dataProvider->sort = [
            'defaultOrder' => ['created_at' => SORT_DESC],
        ];

        return $this->render('category', [
            'model' => $model,
            'dataProvider' => $dataProvider,
            'menuItems' => self::getMenuItems(),
        ]);
    }

    /**
     * Lists the Article models in a specific category $slug.
     *
     * @param $slug
     * @return mixed
     */
    public function actionTag($slug)
    {
        $model = Tag::find()->andWhere(['slug' => $slug])->one();
        if (!$model) {
            throw new NotFoundHttpException(Yii::t('frontend', 'Page not found.'));
        }

        $query = Article::find()->with('category')->joinWith('tags')->where('{{%tag}}.slug = :slug', [':slug' => $slug])->published();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => ['defaultPageSize' => 10],
        ]);

        $dataProvider->sort = [
            'defaultOrder' => ['created_at' => SORT_DESC],
        ];

        return $this->render('tag', [
            'model' => $model,
            'dataProvider' => $dataProvider,
            'menuItems' => self::getMenuItems(),
        ]);
    }

    /**
     * Generate menu items for yii\widgets\Menu
     *
     * @param null|array $models
     * @return array
     */
    public static function getMenuItems(array $models = null)
    {
        $items = [];
        if ($models === null) {
            $models = ArticleCategory::find()->where(['parent_id' => null])->with('childs')->orderBy(['id' => SORT_ASC])->active()->all();
        }
        foreach ($models as $model) {
            $items[] = [
                'url' => ['article/category', 'slug' => $model->slug],
                'label' => $model->title,
                'items' => self::getMenuItems($model->childs),
            ];
        }

        return $items;
    }
}
