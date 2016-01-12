<?php

namespace frontend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use frontend\models\Bids;

/**
 * BidsSearch represents the model behind the search form about `frontend\models\Bids`.
 */
class BidsSearch extends Bids
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'activity_id', 'offer_id', 'order_id', 'loc_id', 'period', 'period_unit', 'currency_id', 'fixed_price', 'warranty', 'hit_counter'], 'integer'],
            [['delivery_starts', 'price_per', 'note', 'spec', 'reject_reason', 'report_reason', 'time'], 'safe'],
            [['price', 'price_per_unit'], 'number'],
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
        $query = Bids::find();

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
            'activity_id' => $this->activity_id,
            'offer_id' => $this->offer_id,
            'order_id' => $this->order_id,
            'loc_id' => $this->loc_id,
            'period' => $this->period,
            'period_unit' => $this->period_unit,
            'delivery_starts' => $this->delivery_starts,
            'price' => $this->price,
            'currency_id' => $this->currency_id,
            'price_per_unit' => $this->price_per_unit,
            'fixed_price' => $this->fixed_price,
            'warranty' => $this->warranty,
            'time' => $this->time,
            'hit_counter' => $this->hit_counter,
        ]);

        $query->andFilterWhere(['like', 'price_per', $this->price_per])
            ->andFilterWhere(['like', 'note', $this->note])
            ->andFilterWhere(['like', 'spec', $this->spec])
            ->andFilterWhere(['like', 'reject_reason', $this->reject_reason])
            ->andFilterWhere(['like', 'report_reason', $this->report_reason]);

        return $dataProvider;
    }
}
