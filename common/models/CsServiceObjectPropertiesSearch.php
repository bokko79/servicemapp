<?php

namespace common\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\CsServiceObjectProperties;

/**
 * CsServiceObjectPropertiesSearch represents the model behind the search form about `common\models\CsServiceObjectProperties`.
 */
class CsServiceObjectPropertiesSearch extends CsServiceObjectProperties
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'service_id', 'object_property_id', 'requirement', 'readOnly'], 'integer'],
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
        $query = CsServiceObjectProperties::find();

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
            'service_id' => $this->service_id,
            'object_property_id' => $this->object_property_id,
            'requirement' => $this->requirement,
            'readOnly' => $this->readOnly,
        ]);

        return $dataProvider;
    }
}
