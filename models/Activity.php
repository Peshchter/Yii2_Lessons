<?php

namespace app\models;

class Activity extends \yii\base\Model
{
    public $name;           //имя
    public $description;    //описание
    public $start;          //начало события (timestamp)
    public $finish;         //конец события (timestamp)
    public $repeatable;     //повторяемое
    public $blocker;        //блокирующее
}
