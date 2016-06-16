<?php

namespace common\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\CsRegulationsTranslation;

/**
 * CsRegulationsTranslationSearch represents the model behind the search form about `common\models\CsRegulationsTranslation`.
 */
class CsRegulationsTranslationSearch extends CsRegulationsTranslation
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'regulation_id'], 'integer'],
            [['lang_code', 'name', 'orig_name', 'description', 'body'], 'safe'],
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
        $query = CsRegulationsTranslation::find();

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
            'regulation_id' => $this->regulation_id,
        ]);

        $query->andFilterWhere(['like', 'lang_code', $this->lang_code])
            ->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'orig_name', $this->orig_name])
            ->andFilterWhere(['like', 'description', $this->description])
            ->andFilterWhere(['like', 'body', $this->body]);

        return $dataProvider;
    }
}