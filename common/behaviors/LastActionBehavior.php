<?php

namespace common\behaviors;

use Yii;
use yii\base\Behavior;
use yii\base\Controller;

/**
 * Class LastActionBehavior.
 */
class LastActionBehavior extends Behavior
{
    /**
     * @var string
     */
    public $attribute = 'action_at';

    /**
     * @inheritdoc
     */
    public function events()
    {
        return [
            Controller::EVENT_BEFORE_ACTION => 'beforeAction',
        ];
    }

    /**
     * @inheritdoc
     */
    public function beforeAction()
    {
        if (!Yii::$app->user->isGuest) {
            $model = Yii::$app->user->identity;
            $model->touch($this->attribute);
        }

        return true;
    }
}
