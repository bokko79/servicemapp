<?php

namespace common\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\CsProducts;

/**
 * CsProductsSearch represents the model behind the search form about `common\models\CsProducts`.
 */
class CsProductsSearch extends CsProducts
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'object_id', 'object_property_id', 'product_id', 'base_product_id', 'predecessor_id', 'successor_id'], 'integer'],
            [['property_name', 'name', 'level', 'class', 'description'], 'safe'],
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
        $query = CsProducts::find();

        $query->joinWith(['object', 'objectProperty']);

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
            'object_property_id' => $this->object_property_id,
            'product_id' => $this->product_id,
            'base_product_id' => $this->base_product_id,
            'predecessor_id' => $this->predecessor_id,
            'successor_id' => $this->successor_id,
        ]);

        $query->andFilterWhere(['like', 'cs_products.property_name', $this->property_name])
            ->andFilterWhere(['like', 'cs_products.name', $this->name])
            ->andFilterWhere(['like', 'cs_products.level', $this->level])
            ->andFilterWhere(['like', 'cs_products.class', $this->class])
            ->andFilterWhere(['like', 'cs_products.description', $this->description]);

        return $dataProvider;
    }
}
