<?php

namespace common\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\User;

/**
 * UserSearch represents the model behind the search form about `app\models\User`.
 */
class UserSearch extends User
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'is_provider', 'registered_by', 'type', 'login_count', 'online_status', 'last_activity', 'status', 'created_at', 'updated_at'], 'integer'],
            [['username', 'auth_key', 'password_hash', 'password_reset_token', 'email', 'email_reset_hash', 'email_reset_time', 'fullname', 'ip_address', 'activation_hash', 'activation_time', 'invite_hash', 'last_login_time', 'login_hash', 'phone', 'phone_verification_hash', 'phone_verification_time', 'rememberme_token', 'role_code'], 'safe'],
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
        $query = User::find();

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
            'email_reset_time' => $this->email_reset_time,
            'is_provider' => $this->is_provider,
            'activation_time' => $this->activation_time,
            'registered_by' => $this->registered_by,
            'type' => $this->type,
            'last_login_time' => $this->last_login_time,
            'login_count' => $this->login_count,
            'online_status' => $this->online_status,
            'last_activity' => $this->last_activity,
            'phone_verification_time' => $this->phone_verification_time,
            'status' => $this->status,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ]);

        $query->andFilterWhere(['like', 'username', $this->username])
            ->andFilterWhere(['like', 'auth_key', $this->auth_key])
            ->andFilterWhere(['like', 'password_hash', $this->password_hash])
            ->andFilterWhere(['like', 'password_reset_token', $this->password_reset_token])
            ->andFilterWhere(['like', 'email', $this->email])
            ->andFilterWhere(['like', 'email_reset_hash', $this->email_reset_hash])
            ->andFilterWhere(['like', 'fullname', $this->fullname])
            ->andFilterWhere(['like', 'ip_address', $this->ip_address])
            ->andFilterWhere(['like', 'activation_hash', $this->activation_hash])
            ->andFilterWhere(['like', 'invite_hash', $this->invite_hash])
            ->andFilterWhere(['like', 'login_hash', $this->login_hash])
            ->andFilterWhere(['like', 'phone', $this->phone])
            ->andFilterWhere(['like', 'phone_verification_hash', $this->phone_verification_hash])
            ->andFilterWhere(['like', 'rememberme_token', $this->rememberme_token])
            ->andFilterWhere(['like', 'role_code', $this->role_code]);

        return $dataProvider;
    }
}
