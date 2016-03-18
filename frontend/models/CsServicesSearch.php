<?php

namespace frontend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use frontend\models\CsServices;

/**
 * CsServicesSearch represents the model behind the search form about `frontend\models\CsServices`.
 */
class CsServicesSearch extends CsServices
{
    public $tag_id;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'industry_id', 'action_id', 'object_id', 'unit_id', 'process', 'geospecific', 'added_by', 'hit_counter'], 'integer'],
            [['tag_id', 'name', 'action', 'object_name', 'service_type', 'amount', 'pic', 'service_object', 'consumer', 'support', 'location', 'time', 'duration', 'turn_key', 'tools', 'labour_type', 'frequency', 'coverage', 'dat', 'status', 'added_time'], 'safe'],
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
        ]);

        $query->andFilterWhere(['like', 'name', $this->name]);

        return $dataProvider;
    }
}
