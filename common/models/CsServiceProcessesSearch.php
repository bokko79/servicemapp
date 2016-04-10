<?php

namespace common\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\CsServiceProcesses;

/**
 * CsServiceProcessesSearch represents the model behind the search form about `common\models\CsServiceProcesses`.
 */
class CsServiceProcessesSearch extends CsServiceProcesses
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'process_id', 'service_id', 'service_order_no'], 'integer'],
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
        $query = CsServiceProcesses::find();

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
            'process_id' => $this->process_id,
            'service_id' => $this->service_id,
            'service_order_no' => $this->service_order_no,
        ]);

        $query->andFilterWhere(['like', 'description', $this->description]);

        return $dataProvider;
    }
}
