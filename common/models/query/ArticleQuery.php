<?php

namespace common\models\query;

use yii\db\ActiveQuery;
use common\models\Article;
use creocoder\taggable\TaggableQueryBehavior;

/**
 * This is the ActiveQuery class for [[\common\models\Article]].
 *
 * @see \common\models\Article
 */
class ArticleQuery extends ActiveQuery
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            TaggableQueryBehavior::class,
        ];
    }

    /**
     * @return $this
     */
    public function published()
    {
        $this->andWhere(['{{%article}}.status' => Article::STATUS_ACTIVE]);
        $this->andWhere(['<', '{{%article}}.published_at', time()]);

        return $this;
    }
}
