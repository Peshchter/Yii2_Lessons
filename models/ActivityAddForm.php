<?php

namespace app\models;

use yii\base\Model;

class ActivityAddForm extends Model
{
    public $name;
    public $description;
    public $start ;
    public $finish;
    public $repeatable = false;
    public $blocker = false;


    /**
     * @return array the validation rules.
     */
    public function rules()
    {
        return [
            // name  required
            [['name'], 'required', 'message'=>'{attribute} нельзя оставлять пустым!'],
            [['repeatable', 'blocker'],'boolean']
        ];
    }

    /**
     * @return array customized attribute labels
     */
    public function attributeLabels()
    {
        return [
            'name' => 'Событие',
            'description' => 'Краткое описание',
            'start' => 'Начало',
            'finish' => 'Конец',
            'repeatable' => 'Повторять?',
            'blocker' => 'Главное событие дня?',
        ];
    }
}