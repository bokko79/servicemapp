<?php

namespace common\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\CsPropertyModels;

/**
 * CsPropertyModelsSearch represents the model behind the search form about `common\models\CsPropertyModels`.
 */
class CsPropertyModelsSearch extends CsPropertyModels
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'property_id', 'selected_value', 'image_id', 'entry_by'], 'integer'],
            [['name', 'property_name', 'hint', 'entry_time', 'description'], 'safe'],
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
        $query = CsPropertyModels::find();

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
            'entry_by' => $this->entry_by,
            'entry_time' => $this->entry_time,
        ]);

        $query->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'property_name', $this->property_name])
            ->andFilterWhere(['like', 'hint', $this->hint])
            ->andFilterWhere(['like', 'description', $this->description]);

        return $dataProvider;
    }
}
