<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "user_notifications_sms".
 *
 * @property string $user_id
 * @property integer $new_req
 * @property integer $exp_req
 * @property integer $succ_req
 * @property integer $new_bid
 * @property integer $awa_bid
 * @property integer $exp_bid
 * @property integer $new_rev
 * @property integer $new_rate
 * @property integer $new_deal
 * @property integer $subs_deal
 * @property integer $exp_deal
 * @property integer $upd_memb
 * @property integer $exp_memb
 * @property integer $jubilee
 * @property string $update_time
 *
 * @property User $user
 */
class UserNotificationsSms extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'user_notifications_sms';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['user_id', 'update_time'], 'required'],
            [['user_id', 'new_req', 'exp_req', 'succ_req', 'new_bid', 'awa_bid', 'exp_bid', 'new_rev', 'new_rate', 'new_deal', 'subs_deal', 'exp_deal', 'upd_memb', 'exp_memb', 'jubilee'], 'integer'],
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
            'exp_req' => 'Exp Req',
            'succ_req' => 'Succ Req',
            'new_bid' => 'New Bid',
            'awa_bid' => 'Awa Bid',
            'exp_bid' => 'Exp Bid',
            'new_rev' => 'New Rev',
            'new_rate' => 'New Rate',
            'new_deal' => 'New Deal',
            'subs_deal' => 'Subs Deal',
            'exp_deal' => 'Exp Deal',
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
