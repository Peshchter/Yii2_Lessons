<?php
/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */

/* @var $model app\models\Activity */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$this->title = 'Просмотр события';
$this->params['breadcrumbs'][] = $this->title;
$model->name = 'День рождения';
$model->description = 'Главное событие жизни ребенка';
$model->start = time();
$model->blocker = true;
?>

<div class="site-about">
    <h1><?= $model->name ?></h1>
    <p><?= $model->description ?></p>
    <p>
        <?php if ($model->blocker) {
            echo "Продлится весь день " . date("d F Y", $model->start);
        } else {
            echo "Начинается " . date("H:i d/m/Y", $model->start) . " и продлится до " .
                date("H:i d/m/Y", $model->finish);
        }
        ?>
    </p>
    <?= Html::a('Назад', \yii\helpers\Url::previous(),  ['class'=>'btn btn-info']);   ?>
    <?= Html::a('Редактировать', \yii\helpers\Url::to('activity/edit'),  ['class'=>'btn btn-warning']); ?>
</div>