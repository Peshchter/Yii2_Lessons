<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Activity;

/**
 * ActivitySearch represents the model behind the search form of `app\models\Activity`.
 */
class ActivitySearch extends Activity
{

    public $userName;
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id',  'user_id',  'created_at', 'updated_at'], 'integer'],
            [['name', 'description'], 'safe'],
            [['repeatable', 'blocker'], 'check'],
            [['userName'], 'string'],
            [['start', 'finish'], 'date', 'format' => 'php:d.m.Y'],
        ];
    }

    public function check()
    {
        return true;
    }

    /**
     * {@inheritdoc}
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $query = Activity::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        if (!empty($this->start))
        {
            $dayStart = (int)\Yii::$app->formatter->asTimestamp($this->start . ' 00:00:00');
            $dayFinish = (int)\Yii::$app->formatter->asTimestamp($this->start . ' 23:59:59');
            $query->andWhere(['between', 'start', $dayStart, $dayFinish]);
        }

        if (!empty($this->finish))
        {
            $dayStart = (int)\Yii::$app->formatter->asTimestamp($this->finish . ' 00:00:00');
            $dayFinish = (int)\Yii::$app->formatter->asTimestamp($this->finish . ' 23:59:59');
            $query->andWhere(['between', 'finish', $dayStart, $dayFinish]);
        }


        if (!empty($this->userName))
        {
            $query->joinWith('user');
            $query->andWhere(['like', 'users.username', $this->userName]);
        }
        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'repeatable' => $this->repeatable,
            'user_id' => $this->user_id,
            'blocker' => $this->blocker,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ]);

        if (\Yii::$app->user->identity->role != 'admin') {
            $query->andWhere(['=', 'user_id', \Yii::$app->user->id] );
        }

        $query->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'description', $this->description]);

        return $dataProvider;
    }
}
