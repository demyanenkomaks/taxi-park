<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\User;

/**
 * UserSearch represents the model behind the search form of `common\models\User`.
 */
class UserSearch extends User
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'status', 'created_at', 'updated_at', 'hitched', 'children', 'p_sex', 'park', 'identifier', 'hr_id', 'mod_ident'], 'integer'],
            [['username', 'auth_key', 'password_hash', 'password_reset_token', 'email', 'verification_token', 'city', 'citizenship', 'cart_bank', 'cart_num', 'cart_other', 'p_num', 'p_f', 'p_i', 'p_o', 'p_date_birth', 'p_place_birth', 'p_date_vydachi', 'p_code_unit', 'p_p_date', 'p_p_region', 'p_p_point', 'p_p_yl', 'p_p_dom', 'p_p_korp', 'p_p_kvart', 'p_p_registered', 'urlUpload', 'login', 'prava_num', 'prava_date', 'prava_cat', 'files_prava_1', 'files_prava_2', 'files_pas_1', 'files_pas_2', 'files_pas_3', 'park_name'], 'safe'],
            [['skill_taxi'], 'number'],
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
        $query = User::find()->joinWith(['updateUser0 upUs', 'hrUser0 hrUs', 'userInHr0 countUs', 'countUserRawInHr0 countRawUs'])->distinct();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => ['pageSize' => 50],
            'sort' => [
                'attributes' => [
                    'login',
                    'username',
                    'fio' => [
                        'asc' => ['p_f' => SORT_ASC, 'p_i' => SORT_ASC, 'p_o' => SORT_ASC],
                        'desc' => ['p_f' => SORT_DESC, 'p_i' => SORT_DESC, 'p_o' => SORT_DESC],
                    ],
                    'city',
                    'created_at',
                    'updated_at',
                    'hr_id',
                    'mod_ident',
                ],
                'defaultOrder' => [
                    'updated_at' => SORT_DESC,
                ]
            ]

        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        if (Yii::$app->user->can('Модератор HR')) {
            $query->where('user.hr_id = ' . Yii::$app->user->identity->id);
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'user.identifier' => $this->identifier,
            'user.mod_ident' => $this->mod_ident,
        ]);

        $query->andFilterWhere(['like', 'user.login', $this->login])
            ->andFilterWhere(['like', 'user.username', $this->getSaveNumbers($this->username)])
            ->andFilterWhere(['like', 'user.p_f', $this->p_f])
            ->andFilterWhere(['like', 'user.p_i', $this->p_i])
            ->andFilterWhere(['like', 'user.p_o', $this->p_o])
            ->andFilterWhere(['like', 'user.city', $this->city]);

        return $dataProvider;
    }
}
