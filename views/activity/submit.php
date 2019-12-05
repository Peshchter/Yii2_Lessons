<?php

/* @var $this yii\web\View */

/* @var $model \app\models\activity */

use yii\helpers\Html;

$this->title = 'Успешное добавление';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-about">
    <h1><?= Html::encode($this->title) ?></h1>
    <?php if (empty($model)) { ?>
        <p>
            Событие успешно принято. Ниже дамп.
        </p>

        <?= var_dump($_POST) ?>
    <?php } else { ?>
        <div class="site-about">
            <?= var_dump($model) ?>
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
            <?= Html::a('Назад', \yii\helpers\Url::previous(), ['class' => 'btn btn-info']); ?>
            <?= Html::a('Редактировать', \yii\helpers\Url::to('add?id='.$model->id), ['class' => 'btn btn-warning']); ?>
        </div>
    <?php } ?>

</div>
