<?php

namespace frontend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use frontend\models\ProviderIndustryProperties;

/**
 * ProviderIndustrySkillsSearch represents the model behind the search form about `frontend\models\ProviderIndustrySkills`.
 */
class ProviderIndustryPropertiesSearch extends ProviderIndustryProperties
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'provider_industry_id', 'industry_property_id'], 'integer'],
            [['description'], 'safe'],
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
        $query = ProviderIndustrySkills::find();

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
            'provider_industry_id' => $this->provider_industry_id,
            'industry_property_id' => $this->industry_property_id,
        ]);

        $query->andFilterWhere(['like', 'description', $this->description]);

        return $dataProvider;
    }
}
