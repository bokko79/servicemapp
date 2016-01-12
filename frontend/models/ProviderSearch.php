<?php

namespace frontend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use frontend\models\Provider;

/**
 * ProviderSearch represents the model behind the search form about `frontend\models\Provider`.
 */
class ProviderSearch extends Provider
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'user_id', 'industry_id', 'is_active', 'score', 'rate', 'rating', 'hit_counter'], 'integer'],
            [['legal_form', 'phone2', 'phone3', 'website', 'VAT_ID', 'company_no', 'bank_acc_no', 'work_time_start', 'work_time_end', 'registration_time', 'status', 'del_upd_time', 'service_upd_time', 'licence_no', 'licence_hash', 'licence_upd_time'], 'safe'],
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
        $query = Provider::find();

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
            'industry_id' => $this->industry_id,
            'work_time_start' => $this->work_time_start,
            'work_time_end' => $this->work_time_end,
            'registration_time' => $this->registration_time,
            'is_active' => $this->is_active,
            'del_upd_time' => $this->del_upd_time,
            'service_upd_time' => $this->service_upd_time,
            'score' => $this->score,
            'rate' => $this->rate,
            'rating' => $this->rating,
            'licence_upd_time' => $this->licence_upd_time,
            'hit_counter' => $this->hit_counter,
        ]);

        $query->andFilterWhere(['like', 'legal_form', $this->legal_form])
            ->andFilterWhere(['like', 'phone2', $this->phone2])
            ->andFilterWhere(['like', 'phone3', $this->phone3])
            ->andFilterWhere(['like', 'website', $this->website])
            ->andFilterWhere(['like', 'VAT_ID', $this->VAT_ID])
            ->andFilterWhere(['like', 'company_no', $this->company_no])
            ->andFilterWhere(['like', 'bank_acc_no', $this->bank_acc_no])
            ->andFilterWhere(['like', 'status', $this->status])
            ->andFilterWhere(['like', 'licence_no', $this->licence_no])
            ->andFilterWhere(['like', 'licence_hash', $this->licence_hash]);

        return $dataProvider;
    }
}
