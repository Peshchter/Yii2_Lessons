<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */
/* @var $searchModel app\models\ActivitySearch */

$this->title = 'События';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="activity-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Добавить', ['create'], ['class' => 'btn btn-success']) ?>
    </p>


    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'name',
            'description:ntext',
            [
                'attribute' => 'start',
                'filter' => \kartik\date\DatePicker::widget([
                    'model' => $searchModel,
                    'attribute' => 'start',
                    'language' => 'ru',
                    'options' => ['placeholder' => 'Введите дату начала...'],
                    'pluginOptions' => [
                        'autoclose' => true,
                        'todayHighlight' => true,
                        'format' => 'dd.mm.yyyy',
                    ]
                ]),
                'value' => function (\app\models\Activity $model) {
                    return \Yii::$app->formatter->asDate($model->start);
                }
            ],
            [
                'attribute' => 'finish',
                'filter' => \kartik\date\DatePicker::widget([
                    'model' => $searchModel,
                    'attribute' => 'finish',
                    'language' => 'ru',
                    'options' => ['placeholder' => 'Введите дату окончания...'],
                    'pluginOptions' => [
                        'autoclose' => true,
                        'todayHighlight' => true,
                        'format' => 'dd.mm.yyyy',
                    ]
                ]),
                'value' => function (\app\models\Activity $model) {
                    return \Yii::$app->formatter->asDate($model->finish);
                }
            ],
            [
                'attribute' => 'repeatable',
                'value' => function (\app\models\Activity $model) {
                    return $model->blocker ? "Да" : "Нет";
                }
            ],
            [
                'attribute' => 'blocker',
                'value' => function (\app\models\Activity $model) {
                    return $model->blocker ? "Да" : "Нет";
                }
            ],
            [
                'attribute' => 'userName',
                'label' => 'Владелец',
                'format' => 'raw',
                'value' => function (\app\models\Activity $model) {
                    return Html::a($model->user->username, ['/users/view','id'=>$model->user->id]);
                },
            ],

            //'created_at',
            //'updated_at',

            [
                'class' => 'yii\grid\ActionColumn',
                'buttons' => [
                        'mail'=>function($url, $model,$key)
                        {
                            $icon = Html::tag('span', '',['class'=>"glyphicon glyphicon-envelope"]);
                            return Html::a($icon, ['/activity/send','id'=>$model->id,'to'=>$model->user->id]);
                        }
                ],
                'template' => '{view} {update} {delete} {mail}',
                ],
        ],
    ]); ?>


</div>
