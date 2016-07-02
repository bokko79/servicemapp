<?php

namespace common\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\UserObjects;

/**
 * UserObjectsSearch represents the model behind the search form about `common\models\UserObjects`.
 */
class UserObjectsSearch extends UserObjects
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'user_id', 'object_id', 'object_type_id', 'loc_id', 'is_set'], 'integer'],
            [['ime', 'note', 'update_time'], 'safe'],
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
        $query = UserObjects::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        $query->andFilterWhere([
            'id' => $this->id,
            'user_id' => $this->user_id,
            'object_id' => $this->object_id,
            'object_type_id' => $this->object_type_id,
            'loc_id' => $this->loc_id,
            'is_set' => $this->is_set,
            'update_time' => $this->update_time,
        ]);

        $query->andFilterWhere(['like', 'ime', $this->ime])
            ->andFilterWhere(['like', 'note', $this->note]);

        return $dataProvider;
    }
}
