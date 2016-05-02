<?php

namespace common\models\query;

use yii\db\ActiveQuery;
use common\models\User;

/**
 * This is the ActiveQuery class for [[\common\models\User]].
 *
 * @see \common\models\User
 */
class UserQuery extends ActiveQuery
{
    /**
     * @return $this
     */
    public function active()
    {
        $this->andWhere(['status' => User::STATUS_ACTIVE]);
        $this->andWhere(['<', '{{%user}}.created_at', time()]);

        return $this;
    }
}
