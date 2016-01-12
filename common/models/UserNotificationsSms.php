<?php

namespace common\models;

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
            'user_id' => 'Korisnik.',
            'new_req' => 'Notifikacija za novi zahtev za uslugu.',
            'exp_req' => 'Notifikacija za isticanje zahteva za uslugu.',
            'succ_req' => 'Uspešan zahtev za uslugu.',
            'new_bid' => 'Notifikacija za novu ponudu na zahtev.',
            'awa_bid' => 'Notifikacija za uspešnu ponudu na zahtev.',
            'exp_bid' => 'Notifikacija za isticanje ponude na zahtev.',
            'new_rev' => 'Notifikacija za novu recenziju.',
            'new_rate' => 'Notifikacija za novu ocenu.',
            'new_deal' => 'Notifikacija za promociju usluge.',
            'subs_deal' => 'Notifikacija za kupovinu promocije usluge.',
            'exp_deal' => 'Notifikacija za isticanje promocije usluge.',
            'upd_memb' => 'Notifikacija za unapređenje članarine.',
            'exp_memb' => 'Notifikacija za isticanje članstva.',
            'jubilee' => 'Notifikacija za jubilej.',
            'update_time' => 'Datum i vreme izmene podešavanja SMS notifikacija.',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }

    /**
     * @inheritdoc
     * @return UserNotificationsSmsQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new UserNotificationsSmsQuery(get_called_class());
    }
}
