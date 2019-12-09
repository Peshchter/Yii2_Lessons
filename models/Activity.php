<?php

namespace app\models;

use Yii;
use yii\base\NotSupportedException;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;

/**
 * Activity model
 *
 * @property int $id
 * @property string $name
 * @property int $start
 * @property int $finish
 * @property bool $repeatable
 * @property bool $blocker
 * @property int $user_id
 * @property string $description
 * @property int $created_at
 * @property int $updated_at
 */

class Activity extends ActiveRecord
{


    /**
     * @inheritdoc
     */
    public function getId()
    {
        return $this->getPrimaryKey();
    }

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%activity}}';
    }

    /* @return  Activity */
//    public function find($id)
//    {
//        return $this;
//    }


    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            TimestampBehavior::class
        ];
    }


    /**
     * @inheritdoc
     */
    public static function findActivity($id)
    {
        return static::findOne(['id' => $id]);
    }

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
            ['finish','check'],
            ['description','safe'],
        //    [['start','finish'],'date'],
        ];
    }

    public function check()
    {
        $this->start = strtotime($this->start);
        empty($this->finish) ? $this->finish = time() :  $this->finish = strtotime($this->finish);


        if ($this->start > $this->finish)
        {
            $this->finish = $this->start;
        }
    }

    /**
     * {@inheritDoc}
     */

    public function attributeLabels()
    {
        return [
            'id' => 'id',
            'name' => 'Название',
            'start' => 'Начало',
            'finish' => 'Окончание',
            'description' =>'Краткое описание',
            'created_at' => 'Создано',
            'updated_at' => 'Изменено',
            'repeatable' => 'Повторяется?',
            'blocker' => 'Основное?'
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::class, ['id' => 'user_id']);
    }
}
