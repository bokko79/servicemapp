<?php

namespace common\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\CsServiceIndustryPropertyValues;

/**
 * CsServiceIndustryPropertyValuesSearch represents the model behind the search form about `common\models\CsServiceIndustryPropertyValues`.
 */
class CsServiceIndustryPropertyValuesSearch extends CsServiceIndustryPropertyValues
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'service_industry_property_id', 'industry_property_value_id', 'selected_value'], 'integer'],
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
        $query = CsServiceIndustryPropertyValues::find();

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
            'service_industry_property_id' => $this->service_industry_property_id,
            'industry_property_value_id' => $this->industry_property_value_id,
            'selected_value' => $this->selected_value,
        ]);

        return $dataProvider;
    }
}
