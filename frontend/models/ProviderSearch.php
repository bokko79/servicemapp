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
            [['legal_form', 'VAT_ID', 'company_no', 'registration_time', 'status', 'del_upd_time', 'service_upd_time'], 'safe'],
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
            'registration_time' => $this->registration_time,
            'is_active' => $this->is_active,
            'del_upd_time' => $this->del_upd_time,
            'service_upd_time' => $this->service_upd_time,
            'score' => $this->score,
            'rate' => $this->rate,
            'rating' => $this->rating,            
            'hit_counter' => $this->hit_counter,
        ]);

        $query->andFilterWhere(['like', 'legal_form', $this->legal_form])            
            ->andFilterWhere(['like', 'VAT_ID', $this->VAT_ID])
            ->andFilterWhere(['like', 'company_no', $this->company_no])            
            ->andFilterWhere(['like', 'status', $this->status]);

        return $dataProvider;
    }
}
