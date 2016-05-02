<?php

namespace common\components\maintenance\controllers;

use Yii;
use yii\web\Controller;

class MaintenanceController extends Controller
{
    /**
     * Initialize controller.
     */
    public function init()
    {
        $this->layout = Yii::$app->maintenance->layoutPath;
        parent::init();
    }

    /**
     * Index action.
     *
     * @return bool|string
     */
    public function actionIndex()
    {
        if (Yii::$app->request->isAjax) {
            return false;
        }

        return $this->render(Yii::$app->maintenance->viewPath);
    }
}
