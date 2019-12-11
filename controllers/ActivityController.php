<?php

namespace app\controllers;

use app\models\ActivitySearch;
use app\models\User;
use Yii;
use app\models\Activity;
use app\models\ActivityAddForm;
use yii\base\Exception;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

class ActivityController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::class,
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    public function actionIndex()
    {
        $searchModel = new ActivitySearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
//            new ActiveDataProvider([
//            'query' => Activity::find(),
//        ]);
        return $this->render('index', [
            'dataProvider' => $dataProvider,
            'searchModel' => $searchModel,
        ]);
    }

    /**
     * Displays a single Activity model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */

    public function actionView($id = null)
    {
        if (!isset($id)) {
            return $this->render('view', ['model' => new Activity()]);
        } else {
            return $this->render('view', ['model' => $this->findModel($id),]);
        }
    }

    /**
     * Creates a new Activity model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Activity();
       if( $model->load(Yii::$app->request->post()))
       {
           $model->user_id = \Yii::$app->user->id;
           if ($model->save()) {
               return $this->redirect(['view', 'id' => $model->id]);
           }
       }

        return $this->render('create', [
            'model' => $model,
        ]);
    }


    /**
     * Updates an existing Activity model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }
        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Activity model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();
        return $this->redirect(['index']);
    }

    /**
     * Finds the Activity model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Activity the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Activity::findOne($id)) !== null) {
            return $model;
        }
        throw new NotFoundHttpException('The requested page does not exist.');
    }

    public function actionSend()
    {
        if (($recipient = User::findById(\Yii::$app->request->get('to')) !== null)
            && ($activity = Activity::findActivity(\Yii::$app->request->get('id')) !== null)) {
           $mail = \Yii::$app->mailer->compose(
                ['html' => 'notification/html',
                    ['user'=>$recipient, 'activity'=>$activity]])
                ->setFrom("noreply@mail.net")
                ->setTo($recipient->email)
                ->setSubject("Уведомление о событии: ". $activity->name)
                ->setCharset("UTF-8")
                ->send();
        }
        if ($mail === true)
        {
            return $this->redirect(\Yii::$app->request->referrer ?: \Yii::$app->homeUrl);
        }
        else{
            throw new Exception('Отправка не удалась... =(');
        }

    }

}