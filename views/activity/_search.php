<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\date\DatePicker;

/* @var $this yii\web\View */
/* @var $model app\models\ActivitySearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="activity-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>
    <?= $form->field($model, 'name') ?>
    <?= $form->field($model, 'start')->widget(DatePicker::class, [
        'options' => ['placeholder' => 'Введите дату окончания...'],
        'pluginOptions' => [
            'autoclose' => true,
            'language' => 'ru',
            'format' => 'dd.mm.yyyy',
        ]
    ]); ?>
    <?= $form->field($model, 'finish')->widget(DatePicker::class, [
        'options' => ['placeholder' => 'Введите дату окончания...'],
        'pluginOptions' => [
            'autoclose' => true,
            'language' => 'ru',
            'format' => 'dd.mm.yyyy',
        ]
    ]); ?>
    <?= $form->field($model, 'repeatable') ?>
    <?= $form->field($model, 'user_id') ?>
    <?php // echo $form->field($model, 'description') ?>
    <?php // echo $form->field($model, 'blocker') ?>
    <?php // echo $form->field($model, 'created_at') ?>
    <?php // echo $form->field($model, 'updated_at') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
