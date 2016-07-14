<?php

namespace common\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\CsObjects;

/**
 * CsObjectsSearch represents the model behind the search form about `common\models\CsObjects`.
 */
class CsObjectsSearch extends CsObjects
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'object_type_id', 'object_id', 'favour', 'file_id', ], 'integer'],
            [['class', 'name'], 'string'],
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
        $query = CsObjects::find();

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
            'object_type_id' => $this->object_type_id,
            'object_id' => $this->object_id,
            'favour' => $this->favour,
            'file_id' => $this->file_id,
        ]);

        $query->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'class', $this->class]);

        return $dataProvider;
    }
}
