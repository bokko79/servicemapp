<?php

namespace frontend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use frontend\models\ProviderIndustries;

/**
 * ProviderIndustriesSearch represents the model behind the search form about `frontend\models\ProviderIndustries`.
 */
class ProviderIndustriesSearch extends ProviderIndustries
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'provider_id', 'industry_id', 'main'], 'integer'],
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
        $query = ProviderIndustries::find();

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
            'provider_id' => $this->provider_id,
            'industry_id' => $this->industry_id,
            'main' => $this->main,
        ]);

        // grid filtering conditions
        $query->orderBy([
            'main' => SORT_DESC
        ]);

        return $dataProvider;
    }
}
