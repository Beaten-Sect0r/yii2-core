<?php

namespace common\models\query;

use yii\db\ActiveQuery;
use common\models\Menu;

/**
 * This is the ActiveQuery class for [[\common\models\Menu]].
 *
 * @see \common\models\Menu
 */
class MenuQuery extends ActiveQuery
{
    /**
     * @return $this
     */
    public function active()
    {
        $this->andWhere(['status' => Menu::STATUS_ACTIVE]);

        return $this;
    }

    /**
     * @return $this
     */
    public function noParents()
    {
        $this->andWhere('{{%navbar_menu}}.parent_id IS NULL');

        return $this;
    }

    /**
     * @inheritdoc
     * @return \common\models\Menu[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return \common\models\Menu|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
