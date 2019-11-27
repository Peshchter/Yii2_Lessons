<?php

/* @var $this yii\web\View */

use yii\helpers\Html;

$this->title = 'Успешное добавление';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-about">
    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        Событие успешно принято. Ниже дамп.
    </p>
 <?= var_dump($_POST) ?>

</div>
