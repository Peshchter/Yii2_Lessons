<?php
/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model app\models\ActivityAddForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$this->title = 'Добавление события';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-login">
    <h1><?= Html::encode($this->title) ?></h1>
    <?php
    $form = ActiveForm::begin(['method' => 'post', 'action'=>['activity/submit']]);
    echo $form->field($model, 'name')->textInput(['autofocus' => true]);
    echo $form->field($model, 'description')->textarea();
    echo $form->field($model, 'start')->textInput();
    echo $form->field($model, 'finish')->textInput();
    echo $form->field($model, 'repeatable')->checkbox([
        'template' => "<div class=\"col-lg-offset-1 col-lg-3\">{input} {label}</div>\n<div class=\"col-lg-8\">{error}</div>",]);
    echo $form->field($model, 'blocker')->checkbox([
        'template' => "<div class=\"col-lg-offset-1 col-lg-3\">{input} {label}</div>\n<div class=\"col-lg-8\">{error}</div>",]);
    echo Html::submitButton('Добавить',['class'=>'btn btn-success']);
    ActiveForm::end();

    ?>
</div>