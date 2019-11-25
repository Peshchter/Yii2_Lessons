<?php

namespace app\models;

class Day extends \yii\base\Model
{
    public $type;               //тип дня (будни/выходной)
    public $activities = [];    //массив для событий этого дня
}

