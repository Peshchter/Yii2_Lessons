<?php
/**
 * @var $user \app\models\User
 * @var $activity \app\models\Activity
 */
?>
<?= "<p> Уважаемый <b> ". $user->username . "</b>! </p>" ?>
<?= "<p> Напоминаем Вам, что  ". $activity->name ?>
<?= "запланировано с ". $activity->start  ?>
<?= " по  ". $activity->finish . " </p>" ?>



