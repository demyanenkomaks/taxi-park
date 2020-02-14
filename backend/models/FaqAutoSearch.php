<?php

namespace backend\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\FaqAuto;

/**
 * FaqAutoSearch represents the model behind the search form of `backend\models\FaqAuto`.
 */
class FaqAutoSearch extends FaqAuto
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'economy', 'comfort', 'comfort_plus', 'business', 'premium', 'minivan', 'child', 'created_at', 'updated_at', 'user'], 'integer'],
            [['auto'], 'safe'],
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
        $query = FaqAuto::find();

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
            'economy' => $this->economy,
            'comfort' => $this->comfort,
            'comfort_plus' => $this->comfort_plus,
            'business' => $this->business,
            'premium' => $this->premium,
            'minivan' => $this->minivan,
            'child' => $this->child,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'user' => $this->user,
        ]);

        $query->andFilterWhere(['like', 'auto', $this->auto]);

        return $dataProvider;
    }
}
