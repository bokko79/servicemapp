<?php

namespace common\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\CsServiceOrderingFlow;

/**
 * CsServiceOrderingFlowSearch represents the model behind the search form about `common\models\CsServiceOrderingFlow`.
 */
class CsServiceOrderingFlowSearch extends CsServiceOrderingFlow
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['service_id', 'industry_properties', 'object_container', 'object_models', 'object_properties', 'object_files', 'object_issues', 'action_properties', 'quantitites', 'locations', 'times', 'budget', 'advanced', 'notifications', 'terms'], 'integer'],
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
        $query = CsServiceOrderingFlow::find();

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
            'service_id' => $this->service_id,
            'industry_properties' => $this->industry_properties,
            'object_container' => $this->object_container,
            'object_models' => $this->object_models,
            'object_properties' => $this->object_properties,
            'object_files' => $this->object_files,
            'object_issues' => $this->object_issues,
            'action_properties' => $this->action_properties,
            'quantitites' => $this->quantitites,
            'locations' => $this->locations,
            'times' => $this->times,
            'budget' => $this->budget,
            'advanced' => $this->advanced,
            'notifications' => $this->notifications,
            'terms' => $this->terms,
        ]);

        return $dataProvider;
    }
}
