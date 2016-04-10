<?php

namespace common\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\CsProperties;

/**
 * CsPropertiesSearch represents the model behind the search form about `common\models\CsProperties`.
 */
class CsPropertiesSearch extends CsProperties
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'unit_id', 'type'], 'integer'],
            [['name', 'class', 'mark', 'description'], 'safe'],
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
        $query = CsProperties::find();

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
            'unit_id' => $this->unit_id,
            'type' => $this->type,
        ]);

        $query->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'class', $this->class])
            ->andFilterWhere(['like', 'mark', $this->mark])
            ->andFilterWhere(['like', 'description', $this->description]);

        return $dataProvider;
    }
}
