<?php

namespace frontend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use frontend\models\Orders;

/**
 * OrdersSearch represents the model behind the search form about `frontend\models\Orders`.
 */
class OrdersSearch extends Orders
{
    public $service; 

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['activity_id'], 'required'],
            [['activity_id', 'registered_to', 'process_id', 'loc_id', 'loc_id2', 'coverage', 'coverage_within', 'consumer', 'consumer_to', 'consumer_children', 'frequency', 'budget', 'currency_id', 'shipping', 'installation', 'support', 'turn_key', 'tools', 'phone_contact', 'success', 'hit_counter'], 'integer'],
            [['delivery_starts', 'delivery_ends', 'validity', 'success_time', 'update_time'], 'safe'],
            [['service'], 'safe'],
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
        $query = Orders::find();

        $query->joinWith(['activity', 'services']);

        $query->andFilterWhere([
            'activities.user_id' => Yii::$app->user->id,
        ]);

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        // Important: here is how we set up the sorting
        // The key is the attribute name
        $dataProvider->sort->attributes['time_asc'] = [
            'asc' => ['activities.time' => SORT_ASC],
        ];
        $dataProvider->sort->attributes['time_desc'] = [
            'asc' => ['activities.time' => SORT_DESC],
        ];

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        /*$query->andFilterWhere([
            'id' => $this->id,
            'activity_id' => $this->activity_id,
            'loc_id' => $this->loc_id,
            'loc_id2' => $this->loc_id2,
            'loc_within' => $this->loc_within,
            'delivery_starts' => $this->delivery_starts,
            'delivery_ends' => $this->delivery_ends,
            'orders.validity' => $this->validity,
            'update_time' => $this->update_time,
            'registered_to' => $this->registered_to,
            'phone_contact' => $this->phone_contact,
            'turn_key' => $this->turn_key,
            'process_id' => $this->process_id,
            'success' => $this->success,
            'success_time' => $this->success_time,
            'hit_counter' => $this->hit_counter,
        ]);

        $query->andFilterWhere(['like', 'lang_code', $this->lang_code])
            ->andFilterWhere(['like', 'class', $this->class])
            ->andFilterWhere(['like', 'order_type', $this->order_type]);*/

        $query->andFilterWhere(['like', 'cs_services.name', $this->service]);

        return $dataProvider;
    }
}
