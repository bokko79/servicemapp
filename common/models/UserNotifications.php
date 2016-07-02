<?php

namespace common\models;

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
            [['update_time'], 'safe'],
            [['update_time'], 'default', 'value' => function ($model, $attribute) {
                return date('Y-m-d H:i:s');
            }],
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
            'upd_req' => Yii::t('app', 'Upd Req'),
            'del_req' => Yii::t('app', 'Del Req'),
            'exp_req' => Yii::t('app', 'Exp Req'),
            'succ_req' => Yii::t('app', 'Succ Req'),
            'new_bid' => Yii::t('app', 'New Bid'),
            'upd_bid' => Yii::t('app', 'Upd Bid'),
            'del_bid' => Yii::t('app', 'Del Bid'),
            'rej_bid' => Yii::t('app', 'Rej Bid'),
            'rep_bid' => Yii::t('app', 'Rep Bid'),
            'awa_bid' => Yii::t('app', 'Awa Bid'),
            'exp_bid' => Yii::t('app', 'Exp Bid'),
            'new_rev' => Yii::t('app', 'New Rev'),
            'new_rate' => Yii::t('app', 'New Rate'),
            'new_comm' => Yii::t('app', 'New Comm'),
            'new_rcmnd' => Yii::t('app', 'New Rcmnd'),
            'new_deal' => Yii::t('app', 'New Deal'),
            'subs_deal' => Yii::t('app', 'Subs Deal'),
            'upd_deal' => Yii::t('app', 'Upd Deal'),
            'exp_deal' => Yii::t('app', 'Exp Deal'),
            'del_deal' => Yii::t('app', 'Del Deal'),
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
