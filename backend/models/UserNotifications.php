<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "user_notifications".
 *
 * @property string $user_id
 * @property integer $new_req
 * @property integer $upd_req
 * @property integer $del_req
 * @property integer $exp_req
 * @property integer $succ_req
 * @property integer $new_bid
 * @property integer $upd_bid
 * @property integer $del_bid
 * @property integer $rej_bid
 * @property integer $rep_bid
 * @property integer $awa_bid
 * @property integer $exp_bid
 * @property integer $new_rev
 * @property integer $new_rate
 * @property integer $new_comm
 * @property integer $new_rcmnd
 * @property integer $new_deal
 * @property integer $subs_deal
 * @property integer $upd_deal
 * @property integer $exp_deal
 * @property integer $del_deal
 * @property integer $upd_memb
 * @property integer $exp_memb
 * @property integer $jubilee
 * @property string $update_time
 *
 * @property User $user
 */
class UserNotifications extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'user_notifications';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['user_id', 'update_time'], 'required'],
            [['user_id', 'new_req', 'upd_req', 'del_req', 'exp_req', 'succ_req', 'new_bid', 'upd_bid', 'del_bid', 'rej_bid', 'rep_bid', 'awa_bid', 'exp_bid', 'new_rev', 'new_rate', 'new_comm', 'new_rcmnd', 'new_deal', 'subs_deal', 'upd_deal', 'exp_deal', 'del_deal', 'upd_memb', 'exp_memb', 'jubilee'], 'integer'],
            [['update_time'], 'safe']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'user_id' => 'User ID',
            'new_req' => 'New Req',
            'upd_req' => 'Upd Req',
            'del_req' => 'Del Req',
            'exp_req' => 'Exp Req',
            'succ_req' => 'Succ Req',
            'new_bid' => 'New Bid',
            'upd_bid' => 'Upd Bid',
            'del_bid' => 'Del Bid',
            'rej_bid' => 'Rej Bid',
            'rep_bid' => 'Rep Bid',
            'awa_bid' => 'Awa Bid',
            'exp_bid' => 'Exp Bid',
            'new_rev' => 'New Rev',
            'new_rate' => 'New Rate',
            'new_comm' => 'New Comm',
            'new_rcmnd' => 'New Rcmnd',
            'new_deal' => 'New Deal',
            'subs_deal' => 'Subs Deal',
            'upd_deal' => 'Upd Deal',
            'exp_deal' => 'Exp Deal',
            'del_deal' => 'Del Deal',
            'upd_memb' => 'Upd Memb',
            'exp_memb' => 'Exp Memb',
            'jubilee' => 'Jubilee',
            'update_time' => 'Update Time',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }
}
