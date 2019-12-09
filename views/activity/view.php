<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Activity */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'События', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="activity-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'name',
            'description:ntext',
            'start:date',
            'finish:date',
            [
                'attribute' => 'repeatable',
                'value' => function (\app\models\Activity $model) {
                    return $model->blocker ? "Да" : "Нет";
                }
            ],
            [
                'attribute' => 'user_id',
                'label' => 'Владелец',
                'value' => function (\app\models\Activity $model) {
                    return $model->user->username;
                }
            ],

            [
                'attribute' => 'blocker',
                'value' => function (\app\models\Activity $model) {
                    return $model->blocker ? "Да" : "Нет";
                }
            ],

            'created_at:date',
            'updated_at:date',
        ],
    ]) ?>

</div>