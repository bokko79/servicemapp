<?php

namespace common\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\UserPayment;

/**
 * UserPaymentsSearch represents the model behind the search form about `common\models\UserPayment`.
 */
class UserPaymentsSearch extends UserPayment
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'user_id'], 'integer'],
            [['payment_type', 'details', 'card_no', 'exp_mnth', 'exp_year', 'scc', 'first_name', 'last_name', 'street', 'city', 'zip', 'country', 'status', 'time'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
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
        $query = UserPayment::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        $query->andFilterWhere([
            'id' => $this->id,
            'user_id' => $this->user_id,
            'exp_year' => $this->exp_year,
            'time' => $this->time,
        ]);

        $query->andFilterWhere(['like', 'payment_type', $this->payment_type])
            ->andFilterWhere(['like', 'details', $this->details])
            ->andFilterWhere(['like', 'card_no', $this->card_no])
            ->andFilterWhere(['like', 'exp_mnth', $this->exp_mnth])
            ->andFilterWhere(['like', 'scc', $this->scc])
            ->andFilterWhere(['like', 'first_name', $this->first_name])
            ->andFilterWhere(['like', 'last_name', $this->last_name])
            ->andFilterWhere(['like', 'street', $this->street])
            ->andFilterWhere(['like', 'city', $this->city])
            ->andFilterWhere(['like', 'zip', $this->zip])
            ->andFilterWhere(['like', 'country', $this->country])
            ->andFilterWhere(['like', 'status', $this->status]);

        return $dataProvider;
    }
}
