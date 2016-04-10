<?php

namespace common\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\CsUnitsTranslation;

/**
 * CsUnitsTranslationSearch represents the model behind the search form about `common\models\CsUnitsTranslation`.
 */
class CsUnitsTranslationSearch extends CsUnitsTranslation
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'unit_id'], 'integer'],
            [['lang_code', 'name', 'name_gen', 'name_imp', 'oznaka', 'oznaka_imp', 'ozn_htmlfree', 'ozn_htmlfree_imp', 'orig_name', 'description'], 'safe'],
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
        $query = CsUnitsTranslation::find();

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
            'unit_id' => $this->unit_id,
        ]);

        $query->andFilterWhere(['like', 'lang_code', $this->lang_code])
            ->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'name_gen', $this->name_gen])
            ->andFilterWhere(['like', 'name_imp', $this->name_imp])
            ->andFilterWhere(['like', 'oznaka', $this->oznaka])
            ->andFilterWhere(['like', 'oznaka_imp', $this->oznaka_imp])
            ->andFilterWhere(['like', 'ozn_htmlfree', $this->ozn_htmlfree])
            ->andFilterWhere(['like', 'ozn_htmlfree_imp', $this->ozn_htmlfree_imp])
            ->andFilterWhere(['like', 'orig_name', $this->orig_name])
            ->andFilterWhere(['like', 'description', $this->description]);

        return $dataProvider;
    }
}
