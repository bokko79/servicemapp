<?php

namespace frontend\models;

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
            'user_id' => Yii::t('app', 'User ID'),
            'new_req' => Yii::t('app', 'New Req'),
            'exp_req' => Yii::t('app', 'Exp Req'),
            'succ_req' => Yii::t('app', 'Succ Req'),
            'new_bid' => Yii::t('app', 'New Bid'),
            'awa_bid' => Yii::t('app', 'Awa Bid'),
            'exp_bid' => Yii::t('app', 'Exp Bid'),
            'new_rev' => Yii::t('app', 'New Rev'),
            'new_rate' => Yii::t('app', 'New Rate'),
            'new_deal' => Yii::t('app', 'New Deal'),
            'subs_deal' => Yii::t('app', 'Subs Deal'),
            'exp_deal' => Yii::t('app', 'Exp Deal'),
            'upd_memb' => Yii::t('app', 'Upd Memb'),
            'exp_memb' => Yii::t('app', 'Exp Memb'),
            'jubilee' => Yii::t('app', 'Jubilee'),
            'update_time' => Yii::t('app', 'Update Time'),
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
