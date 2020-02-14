<?php

namespace backend\modules\passenger\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;


/**
 * UserOrderSearch represents the model behind the search form of `backend\modules\passenger\UserOrder`.
 */
class UserOrderSearch extends UserOrder
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'id_user'], 'integer'],
            [['latitude_start', 'longitude_start', 'latitude_stop', 'longitude_stop', 'date', 'time', 'start', 'stop'], 'safe'],
        ];
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
        $query = UserOrder::find()->where(['id_user' => Yii::$app->user->identity->id]);

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

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'id_user' => $this->id_user,
            'date' => $this->date,
            'time' => $this->time,
        ]);

        $query->andFilterWhere(['like', 'start', $this->start])
            ->andFilterWhere(['like', 'stop', $this->stop])
            ->andFilterWhere(['like', 'latitude_start', $this->latitude_start])
            ->andFilterWhere(['like', 'longitude_start', $this->longitude_start])
            ->andFilterWhere(['like', 'latitude_stop', $this->latitude_stop])
            ->andFilterWhere(['like', 'longitude_stop', $this->longitude_stop]);

        return $dataProvider;
    }
}
