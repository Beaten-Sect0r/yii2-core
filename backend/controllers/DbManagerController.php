<?php

namespace backend\controllers;

use yii\web\Controller;

class DbManagerController extends Controller
{
    public function actionIndex()
    {
        return $this->render('index');
    }
}
