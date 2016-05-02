<?php

namespace common\models\query;

use yii\db\ActiveQuery;
use common\models\ArticleCategory;

/**
 * This is the ActiveQuery class for [[\common\models\ArticleCategory]].
 *
 * @see \common\models\ArticleCategory
 */
class ArticleCategoryQuery extends ActiveQuery
{
    /**
     * @return $this
     */
    public function active()
    {
        $this->andWhere(['status' => ArticleCategory::STATUS_ACTIVE]);

        return $this;
    }

    /**
     * @return $this
     */
    public function noParents()
    {
        $this->andWhere('{{%article_category}}.parent_id IS NULL');

        return $this;
    }
}
