<?php

namespace common\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\CsIndustryPropertyValues;

/**
 * CsIndustryPropertyValuesSearch represents the model behind the search form about `common\models\CsIndustryPropertyValues`.
 */
class CsIndustryPropertyValuesSearch extends CsIndustryPropertyValues
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'industry_property_id', 'property_value_id', 'selected_value'], 'integer'],
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
        $query = CsIndustryPropertyValues::find();

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
            'industry_property_id' => $this->industry_property_id,
            'property_value_id' => $this->property_value_id,
            'selected_value' => $this->selected_value,
        ]);

        return $dataProvider;
    }
}
