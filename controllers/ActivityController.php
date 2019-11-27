<?php

namespace app\controllers;

use app\models\Activity;
use app\models\ActivityAddForm;
use yii\web\Controller;

class ActivityController extends Controller
{
    public function actionView($id = null)
    {
        if (!isset($id)) {
            return $this->render('view', ['model' => new Activity()]);
        }else{
            $model = new Activity();
            $model->find($id);
            return $this->render('view', ['model' => $model]);
        }
    }

    public function actionAdd()
    {
        $model = new ActivityAddForm();
        return $this->render('add', ['model' => $model,]);
    }

    public function actionSubmit()
    {
        return $this->render('submit');
    }
}