<?php

namespace common\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\CsProductProperties;

/**
 * CsProductPropertiesSearch represents the model behind the search form about `common\models\CsProductProperties`.
 */
class CsProductPropertiesSearch extends CsProductProperties
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'product_id', 'object_property_id', 'property_unit_id', 'property_unit_imperial_id', 'input_type', 'value_min', 'value_max', 'display_order', 'multiple_values', 'specific_values', 'read_only', 'required'], 'integer'],
            [['property_class', 'value_default', 'pattern', 'description'], 'safe'],
            [['step'], 'number'],
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
        $query = CsProductProperties::find();

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
            'product_id' => $this->product_id,
            'object_property_id' => $this->object_property_id,
            'property_unit_id' => $this->property_unit_id,
            'property_unit_imperial_id' => $this->property_unit_imperial_id,
            'input_type' => $this->input_type,
            'value_min' => $this->value_min,
            'value_max' => $this->value_max,
            'step' => $this->step,
            'display_order' => $this->display_order,
            'multiple_values' => $this->multiple_values,
            'specific_values' => $this->specific_values,
            'read_only' => $this->read_only,
            'required' => $this->required,
        ]);

        $query->andFilterWhere(['like', 'property_class', $this->property_class])
            ->andFilterWhere(['like', 'value_default', $this->value_default])
            ->andFilterWhere(['like', 'pattern', $this->pattern])
            ->andFilterWhere(['like', 'description', $this->description]);

        return $dataProvider;
    }
}
