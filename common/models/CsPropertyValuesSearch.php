<?php

namespace common\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\CsPropertyValues;

/**
 * CsPropertyModelsSearch represents the model behind the search form about `common\models\CsPropertyModels`.
 */
class CsPropertyValuesSearch extends CsPropertyValues
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'property_id', 'selected_value', 'image_id'], 'integer'],
            [['value', 'hint'], 'safe'],
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
        $query = CsPropertyValues::find();

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
            'property_id' => $this->property_id,
            'selected_value' => $this->selected_value,
            'image_id' => $this->image_id,
        ]);

        $query->andFilterWhere(['like', 'value', $this->value])
            ->andFilterWhere(['like', 'hint', $this->hint]);

        return $dataProvider;
    }
}
