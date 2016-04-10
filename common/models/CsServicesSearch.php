<?php

namespace common\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\CsServices;

/**
 * CsServicesSearch represents the model behind the search form about `common\models\CsServices`.
 */
class CsServicesSearch extends CsServices
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'image_id', 'industry_id', 'action_id', 'object_id', 'object_model_relevance', 'unit_id', 'amount_default', 'amount_range_min', 'amount_range_max', 'consumer_default', 'consumer_range_min', 'consumer_range_max', 'geospecific', 'process', 'added_by', 'hit_counter'], 'integer'],
            [['name', 'action_name', 'object_name', 'service_type', 'amount', 'consumer', 'consumer_children', 'service_object', 'pic', 'location', 'time', 'duration', 'frequency', 'support', 'turn_key', 'tools', 'labour_type', 'coverage', 'dat', 'availability', 'ordering', 'pricing', 'terms', 'status', 'added_time'], 'safe'],
            [['amount_range_step', 'consumer_range_step'], 'number'],
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
        $query = CsServices::find();

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
            'image_id' => $this->image_id,
            'industry_id' => $this->industry_id,
            'action_id' => $this->action_id,
            'object_id' => $this->object_id,
            'object_model_relevance' => $this->object_model_relevance,
            'unit_id' => $this->unit_id,
            'amount_default' => $this->amount_default,
            'amount_range_min' => $this->amount_range_min,
            'amount_range_max' => $this->amount_range_max,
            'amount_range_step' => $this->amount_range_step,
            'consumer_default' => $this->consumer_default,
            'consumer_range_min' => $this->consumer_range_min,
            'consumer_range_max' => $this->consumer_range_max,
            'consumer_range_step' => $this->consumer_range_step,
            'geospecific' => $this->geospecific,
            'process' => $this->process,
            'added_by' => $this->added_by,
            'added_time' => $this->added_time,
            'hit_counter' => $this->hit_counter,
        ]);

        $query->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'action_name', $this->action_name])
            ->andFilterWhere(['like', 'object_name', $this->object_name])
            ->andFilterWhere(['like', 'service_type', $this->service_type])
            ->andFilterWhere(['like', 'amount', $this->amount])
            ->andFilterWhere(['like', 'consumer', $this->consumer])
            ->andFilterWhere(['like', 'consumer_children', $this->consumer_children])
            ->andFilterWhere(['like', 'service_object', $this->service_object])
            ->andFilterWhere(['like', 'pic', $this->pic])
            ->andFilterWhere(['like', 'location', $this->location])
            ->andFilterWhere(['like', 'time', $this->time])
            ->andFilterWhere(['like', 'duration', $this->duration])
            ->andFilterWhere(['like', 'frequency', $this->frequency])
            ->andFilterWhere(['like', 'support', $this->support])
            ->andFilterWhere(['like', 'turn_key', $this->turn_key])
            ->andFilterWhere(['like', 'tools', $this->tools])
            ->andFilterWhere(['like', 'labour_type', $this->labour_type])
            ->andFilterWhere(['like', 'coverage', $this->coverage])
            ->andFilterWhere(['like', 'dat', $this->dat])
            ->andFilterWhere(['like', 'availability', $this->availability])
            ->andFilterWhere(['like', 'ordering', $this->ordering])
            ->andFilterWhere(['like', 'pricing', $this->pricing])
            ->andFilterWhere(['like', 'terms', $this->terms])
            ->andFilterWhere(['like', 'status', $this->status]);

        return $dataProvider;
    }
}
