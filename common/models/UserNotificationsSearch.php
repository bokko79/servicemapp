<?php

namespace common\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\UserNotifications;

/**
 * UserNotificationsSearch represents the model behind the search form about `common\models\UserNotifications`.
 */
class UserNotificationsSearch extends UserNotifications
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['user_id', 'new_req', 'upd_req', 'del_req', 'exp_req', 'succ_req', 'new_bid', 'upd_bid', 'del_bid', 'rej_bid', 'rep_bid', 'awa_bid', 'exp_bid', 'new_rev', 'new_rate', 'new_comm', 'new_rcmnd', 'new_deal', 'subs_deal', 'upd_deal', 'exp_deal', 'del_deal', 'upd_memb', 'exp_memb', 'jubilee'], 'integer'],
            [['update_time'], 'safe'],
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
        $query = UserNotifications::find();

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
            'user_id' => $this->user_id,
            'new_req' => $this->new_req,
            'upd_req' => $this->upd_req,
            'del_req' => $this->del_req,
            'exp_req' => $this->exp_req,
            'succ_req' => $this->succ_req,
            'new_bid' => $this->new_bid,
            'upd_bid' => $this->upd_bid,
            'del_bid' => $this->del_bid,
            'rej_bid' => $this->rej_bid,
            'rep_bid' => $this->rep_bid,
            'awa_bid' => $this->awa_bid,
            'exp_bid' => $this->exp_bid,
            'new_rev' => $this->new_rev,
            'new_rate' => $this->new_rate,
            'new_comm' => $this->new_comm,
            'new_rcmnd' => $this->new_rcmnd,
            'new_deal' => $this->new_deal,
            'subs_deal' => $this->subs_deal,
            'upd_deal' => $this->upd_deal,
            'exp_deal' => $this->exp_deal,
            'del_deal' => $this->del_deal,
            'upd_memb' => $this->upd_memb,
            'exp_memb' => $this->exp_memb,
            'jubilee' => $this->jubilee,
            'update_time' => $this->update_time,
        ]);

        return $dataProvider;
    }
}
