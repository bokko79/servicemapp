<?php

namespace common\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\CsProductPropertyValues;

/**
 * CsProductPropertyValuesSearch represents the model behind the search form about `common\models\CsProductPropertyValues`.
 */
class CsProductPropertyValuesSearch extends CsProductPropertyValues
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'product_property_id', 'property_value_id', 'selected_value'], 'integer'],
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
        $query = CsProductPropertyValues::find();

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
            'product_property_id' => $this->product_property_id,
            'property_value_id' => $this->property_value_id,
            'selected_value' => $this->selected_value,
        ]);

        $query->andFilterWhere(['like', 'description', $this->description]);

        return $dataProvider;
    }
}
