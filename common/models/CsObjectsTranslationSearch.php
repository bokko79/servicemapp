<?php

namespace common\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\CsObjectsTranslation;

/**
 * CsObjectsTranslationSearch represents the model behind the search form about `common\models\CsObjectsTranslation`.
 */
class CsObjectsTranslationSearch extends CsObjectsTranslation
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'object_id'], 'integer'],
            [['lang_code', 'name', 'name_gen', 'name_dat', 'name_akk', 'name_inst', 'name_gender', 'orig_name', 'description'], 'safe'],
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
        $query = CsObjectsTranslation::find();

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
            'object_id' => $this->object_id,
        ]);

        $query->andFilterWhere(['like', 'lang_code', $this->lang_code])
            ->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'name_gen', $this->name_gen])
            ->andFilterWhere(['like', 'name_dat', $this->name_dat])
            ->andFilterWhere(['like', 'name_akk', $this->name_akk])
            ->andFilterWhere(['like', 'name_inst', $this->name_inst])
            ->andFilterWhere(['like', 'name_gender', $this->name_gender])
            ->andFilterWhere(['like', 'orig_name', $this->orig_name])
            ->andFilterWhere(['like', 'description', $this->description]);

        return $dataProvider;
    }
}
