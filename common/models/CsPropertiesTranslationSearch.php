<?php

namespace common\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\CsPropertiesTranslation;

/**
 * CsPropertiesTranslationSearch represents the model behind the search form about `common\models\CsPropertiesTranslation`.
 */
class CsPropertiesTranslationSearch extends CsPropertiesTranslation
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'property_id'], 'integer'],
            [['lang_code', 'name', 'name_akk', 'hint', 'orig_name', 'description'], 'safe'],
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
        $query = CsPropertiesTranslation::find();

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
            'property_id' => $this->property_id,
        ]);

        $query->andFilterWhere(['like', 'lang_code', $this->lang_code])
            ->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'name_akk', $this->name_akk])
            ->andFilterWhere(['like', 'hint', $this->hint])
            ->andFilterWhere(['like', 'orig_name', $this->orig_name])
            ->andFilterWhere(['like', 'description', $this->description]);

        return $dataProvider;
    }
}
