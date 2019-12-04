<?php


namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\Response;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\ContactForm;
use app\models\User;

class UsersController extends Controller
{

    public function actionAddAdmin() {
        $model = User::find()->where(['username' => 'admin'])->one();
        if (empty($model)) {
            $user = new User();
            $user->username = 'admin';
            $user->email = 'admin@mysite.com';
            $user->setPassword('admin');
            $user->generateAuthKey();
            $user->role = 'admin';
            if ($user->save()) {
                return $this->render('userAdd');
            }
        }
    }

}