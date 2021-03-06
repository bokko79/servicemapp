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
    public $tag_id;
    public $product_id;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'industry_id', 'action_id', 'object_id', 'unit_id', 'process', 'geospecific', 'hit_counter'], 'integer'],
            [['tag_id', 'product_id', 'name', 'action', 'service_type', 'amount', 'pic', 'object_ownership', 'consumer', 'support', 'location', 'time', 'duration', 'turn_key', 'tools', 'labour_type', 'frequency', 'coverage', 'dat', 'status'], 'safe'],
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

        $query->joinWith(['t t']);
        //$query->joinWith(['object', 'products']);

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => [
                'pageSize' => 2,
            ],
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
            //'product_id' => $this->object_id,
        ]);

        $query->andFilterWhere(['like', 't.name', $this->name]);

        return $dataProvider;
    }
}
