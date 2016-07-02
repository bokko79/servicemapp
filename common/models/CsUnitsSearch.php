<?php

namespace common\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\CsUnits;

/**
 * CsUnitsSearch represents the model behind the search form about `\common\models\CsUnits`.
 */
class CsUnitsSearch extends CsUnits
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'conversion_unit'], 'integer'],
            [['name', 'type', 'oznaka', 'ozn_htmlfree', 'measurement'], 'safe'],
            [['conversion_value'], 'number'],
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
        $query = CsUnits::find();

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
            'conversion_unit' => $this->conversion_unit,
            'conversion_value' => $this->conversion_value,
        ]);

        $query->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'type', $this->type])
            ->andFilterWhere(['like', 'oznaka', $this->oznaka])
            ->andFilterWhere(['like', 'ozn_htmlfree', $this->ozn_htmlfree])
            ->andFilterWhere(['like', 'measurement', $this->measurement]);

        return $dataProvider;
    }
}
