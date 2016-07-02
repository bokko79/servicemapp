<?php

namespace frontend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\CsServices;
use common\models\CsObjects;
use common\models\CsIndustries;
use common\models\CsActions;
use common\models\CsTags;

/**
 * CsServicesSearch represents the model behind the search form about `common\models\CsServices`.
 */
class CsAutoServicesSearch extends CsServices
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'industry_id', 'action_id', 'object_id', 'unit_id', 'process', 'geospecific', 'added_by', 'hit_counter'], 'integer'],
            [['name', 'action', 'object_name', 'service_type', 'amount', 'pic', 'service_object', 'consumer', 'support', 'location', 'time', 'duration', 'turn_key', 'tools', 'labour_type', 'frequency', 'coverage', 'dat', 'status', 'added_time'], 'safe'],
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
            'industry_id' => $this->industry_id,
            'action_id' => $this->action_id,
            'object_id' => $this->object_id,
            'unit_id' => $this->unit_id,            
            'process' => $this->process,
            'geospecific' => $this->geospecific,
            'added_by' => $this->added_by,
            'added_time' => $this->added_time,
            'hit_counter' => $this->hit_counter,
        ]);

        /*$query->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'action', $this->action])
            ->andFilterWhere(['like', 'object_name', $this->object_name])
            ->andFilterWhere(['like', 'service_type', $this->service_type])
            ->andFilterWhere(['like', 'amount', $this->amount])
            ->andFilterWhere(['like', 'pic', $this->pic])
            ->andFilterWhere(['like', 'service_object', $this->service_object])
            ->andFilterWhere(['like', 'consumer', $this->consumer])
            ->andFilterWhere(['like', 'support', $this->support])
            ->andFilterWhere(['like', 'location', $this->location])
            ->andFilterWhere(['like', 'time', $this->time])
            ->andFilterWhere(['like', 'duration', $this->duration])
            ->andFilterWhere(['like', 'turn_key', $this->turn_key])
            ->andFilterWhere(['like', 'tools', $this->tools])
            ->andFilterWhere(['like', 'labour_type', $this->labour_type])
            ->andFilterWhere(['like', 'frequency', $this->frequency])
            ->andFilterWhere(['like', 'coverage', $this->coverage])
            ->andFilterWhere(['like', 'dat', $this->dat])
            ->andFilterWhere(['like', 'status', $this->status]);*/

        return $dataProvider;
    }
}
