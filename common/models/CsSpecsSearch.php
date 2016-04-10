<?php

namespace common\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\CsSpecs;

/**
 * CsSpecsSearch represents the model behind the search form about `common\models\CsSpecs`.
 */
class CsSpecsSearch extends CsSpecs
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'object_id', 'property_id', 'range_min', 'range_max', 'range_step', 'display_order', 'required'], 'integer'],
            [['object_name', 'property_name', 'default_value', 'description'], 'safe'],
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
        $query = CsSpecs::find();

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
            'object_id' => $this->object_id,
            'property_id' => $this->property_id,
            'range_min' => $this->range_min,
            'range_max' => $this->range_max,
            'range_step' => $this->range_step,
            'display_order' => $this->display_order,
            'required' => $this->required,
        ]);

        $query->andFilterWhere(['like', 'object_name', $this->object_name])
            ->andFilterWhere(['like', 'property_name', $this->property_name])
            ->andFilterWhere(['like', 'default_value', $this->default_value])
            ->andFilterWhere(['like', 'description', $this->description]);

        return $dataProvider;
    }
}
