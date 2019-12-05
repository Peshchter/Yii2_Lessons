<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Activity */

$this->title = 'Добавление события';
$this->params['breadcrumbs'][] = ['label' => 'События', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="activity-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
