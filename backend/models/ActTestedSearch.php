<?php

namespace backend\models;

use common\models\User;
use yii\base\Model;
use yii\data\ActiveDataProvider;

/**
 * ActTestedSearch represents the model behind the search form of `backend\models\ActTested`.
 */
class ActTestedSearch extends User
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['t_d_t_mod', 't_d_t_adm', 't_d_t_paid'], 'safe'],
            [['username', 't_moderator', 't_admin'], 'string'],
            [['t_paid'], 'boolean']
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
//        debug($params);die;
        $query = User::find()
            ->where(['not', ['user.t_moderator' => null]])
        ;

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => ['pageSize' => 50],
            'sort'=> ['defaultOrder' => ['t_d_t_mod' => SORT_DESC]]
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'user.t_paid' => $this->t_paid,
        ]);

        $query->andFilterWhere(['like', 'user.username', $this->getSaveNumbers($this->username)]);

        if (!empty($this->t_moderator))
        {
            $query->joinWith(['moder0 mod' => function ($q) {
                $q->where("mod.username like '%" . $this->getSaveNumbers($this->t_moderator) . "%' OR mod.login like '%" . $this->t_moderator . "%'");
            }]);
        } else {
            $query->joinWith(['moder0 mod']);
        }

        if (!empty($this->t_admin))
        {
            $query->joinWith(['admin0 adm' => function ($q) {
                $q->where("adm.username like '%" . $this->getSaveNumbers($this->t_admin) . "%' OR adm.login like '%" . $this->t_admin . "%'");
            }]);
        } else {
            $query->joinWith(['moder0 mod']);
        }

        if(!empty($this->t_d_t_mod) && !empty($this->t_d_t_mod[1]) && !empty($this->t_d_t_mod[2])) {
            $query->andWhere(['between', 'DATE_FORMAT(user.t_d_t_mod, \'%Y-%m-%d\')', $this->getSaveDate($this->t_d_t_mod[1]), $this->getSaveDate($this->t_d_t_mod[2])]);
        }

        if(!empty($this->t_d_t_adm) && !empty($this->t_d_t_adm[1]) && !empty($this->t_d_t_adm[2])) {
            $query->andWhere(['between', 'DATE_FORMAT(user.t_d_t_adm, \'%Y-%m-%d\')', $this->getSaveDate($this->t_d_t_adm[1]), $this->getSaveDate($this->t_d_t_adm[2])]);
        }

        if(!empty($this->t_d_t_paid) && !empty($this->t_d_t_paid[1]) && !empty($this->t_d_t_paid[2])) {
            $query->andWhere(['between', 'DATE_FORMAT(user.t_d_t_paid, \'%Y-%m-%d\')', $this->getSaveDate($this->t_d_t_paid[1]), $this->getSaveDate($this->t_d_t_paid[2])]);
        }


        return $dataProvider;
    }
}
