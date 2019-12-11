<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\User */

$this->title = $model->username;
if ($model->role == 'admin') {
    $this->params['breadcrumbs'][] = ['label' => 'Users', 'url' => ['index']];
}
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="user-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Редактировать', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>

        <?= Html::a('Список активностей', ['activity/index'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'username',
            'id',
            'authKey',
            'email:email',
            'status',
            'created_at:date',
            'updated_at:date',
            'role',
        ],
    ]) ?>

</div>
