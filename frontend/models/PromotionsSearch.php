<?php

namespace frontend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use frontend\models\Promotions;

/**
 * PromotionsSearch represents the model behind the search form about `frontend\models\Promotions`.
 */
class PromotionsSearch extends Promotions
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'activity_id', 'offer_id', 'presentation_id', 'old_price', 'new_price', 'currency_id', 'discount', 'voucher', 'max_subscribers', 'scheduling'], 'integer'],
            [['title', 'subtitle', 'promo_text', 'not_valid_for', 'active_from', 'validity', 'time', 'description'], 'safe'],
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
        $query = Promotions::find();

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
            'activity_id' => $this->activity_id,
            'offer_id' => $this->offer_id,
            'presentation_id' => $this->presentation_id,
            'old_price' => $this->old_price,
            'new_price' => $this->new_price,
            'currency_id' => $this->currency_id,
            'discount' => $this->discount,
            'voucher' => $this->voucher,
            'max_subscribers' => $this->max_subscribers,
            'scheduling' => $this->scheduling,
            'active_from' => $this->active_from,
            'validity' => $this->validity,
            'time' => $this->time,
        ]);

        $query->andFilterWhere(['like', 'title', $this->title])
            ->andFilterWhere(['like', 'subtitle', $this->subtitle])
            ->andFilterWhere(['like', 'promo_text', $this->promo_text])
            ->andFilterWhere(['like', 'not_valid_for', $this->not_valid_for])
            ->andFilterWhere(['like', 'description', $this->description]);

        return $dataProvider;
    }
}
