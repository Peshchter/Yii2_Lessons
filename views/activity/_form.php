<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\date\DatePicker;

/* @var $this yii\web\View */
/* @var $model app\models\Activity */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="activity-form">

    <?php $form = ActiveForm::begin(); ?>
    <?= $form->field($model, 'name')->textInput(['maxlength' => true, 'autofocus' => true]) ?>
    <?= $form->field($model, 'description')->textarea(['rows' => 6]) ?>
    <?= $form->field($model, 'start')->widget(DatePicker::classname(), [
        'options' => ['placeholder' => 'Введите дату начала...'],
        'pluginOptions' => [
            'autoclose' => true,
            'language' => 'ru',
            'format' => 'dd MM yyyy',
        ]
    ]); ?>
    <?= $form->field($model, 'finish')->widget(DatePicker::classname(), [
        'options' => ['placeholder' => 'Введите дату окончания...'],
        'pluginOptions' => [
            'autoclose' => true,
            'language' => 'ru',
            'format' => 'dd MM yyyy',
        ]
    ]); ?>
    <?= $form->field($model, 'repeatable')->checkbox([
        'template' => "<div class=\"col-lg-offset-1 col-lg-3\">{input} {label}</div>\n<div class=\"col-lg-8\">{error}</div>",]) ?>
    <?= $form->field($model, 'blocker')->checkbox([
        'template' => "<div class=\"col-lg-offset-1 col-lg-3\">{input} {label}</div>\n<div class=\"col-lg-8\">{error}</div>",]) ?>
    <div class="form-group">
        <?= Html::submitButton('Добавить', ['class' => 'btn btn-success']) ?>
    </div>
    <?php ActiveForm::end(); ?>
</div>
