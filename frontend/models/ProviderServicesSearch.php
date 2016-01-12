<?php

namespace frontend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use frontend\models\ProviderServices;

/**
 * ProviderServicesSearch represents the model behind the search form about `frontend\models\ProviderServices`.
 */
class ProviderServicesSearch extends ProviderServices
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'presentation_id', 'provider_id', 'service_id', 'industry_id', 'loc_id', 'period', 'period_unit', 'price', 'price_max', 'currency_id', 'fixed_price', 'warranty', 'on_sale', 'is_set'], 'integer'],
            [['name', 'description', 'note', 'update_time'], 'safe'],
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
        $query = ProviderServices::find();

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
            'presentation_id' => $this->presentation_id,
            'provider_id' => $this->provider_id,
            'service_id' => $this->service_id,
            'industry_id' => $this->industry_id,
            'loc_id' => $this->loc_id,
            'period' => $this->period,
            'period_unit' => $this->period_unit,
            'price' => $this->price,
            'price_max' => $this->price_max,
            'currency_id' => $this->currency_id,
            'fixed_price' => $this->fixed_price,
            'warranty' => $this->warranty,
            'on_sale' => $this->on_sale,
            'is_set' => $this->is_set,
            'update_time' => $this->update_time,
        ]);

        $query->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'description', $this->description])
            ->andFilterWhere(['like', 'note', $this->note]);

        return $dataProvider;
    }
}
