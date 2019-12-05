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
            [['repeatable', 'blocker'],'boolean'],
            ['start','required'],

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

    /**
     * @var $start_date integer
     * @var $finish_date integer
     * @return integer
     */

    public function checkFinishDate($start_date, $finish_date = 0)
    {
        return $start_date < $finish_date ? $finish_date : $start_date ;
    }

    public function check()
    {
        $activity = new Activity();
        $activity->name = $this->name;
        $activity->description = $this->description;
        $activity->blocker = $this->blocker;
        $activity->repeatable = $this->repeatable;
        $activity->user_id = \Yii::$app->user->id;
        $activity->start = $this->start;
        $activity->finish = $this->checkFinishDate($this->start, $this->finish);
        return $activity->save() ? $activity : null;
    }

}