<?php

namespace common\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\CsServiceObjectPropertyValues;

/**
 * CsServiceObjectPropertyValuesSearch represents the model behind the search form about `common\models\CsServiceObjectPropertyValues`.
 */
class CsServiceObjectPropertyValuesSearch extends CsServiceObjectPropertyValues
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'service_object_property_id', 'object_property_value_id'], 'integer'],
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
        $query = CsServiceObjectPropertyValues::find();

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
            'service_object_property_id' => $this->service_object_property_id,
            'object_property_value_id' => $this->object_property_value_id,
        ]);

        return $dataProvider;
    }
}
