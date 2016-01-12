<?php

namespace frontend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use frontend\models\MsgThread;

/**
 * MsgThreadSearch represents the model behind the search form about `frontend\models\MsgThread`.
 */
class MsgThreadSearch extends MsgThread
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'sender', 'receiver', 'is_read', 'is_read_rec', 'del', 'delbyrec'], 'integer'],
            [['time'], 'safe'],
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
        $query = MsgThread::find();

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
            'sender' => $this->sender,
            'receiver' => $this->receiver,
            'is_read' => $this->is_read,
            'is_read_rec' => $this->is_read_rec,
            'del' => $this->del,
            'delbyrec' => $this->delbyrec,
            'time' => $this->time,
        ]);

        return $dataProvider;
    }
}
