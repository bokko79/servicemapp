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
            'upd_req' => 'Notifikacija za izmenu zahteva za uslugu.',
            'del_req' => 'Notifikacija za brisanje zahteva za uslugu.',
            'exp_req' => 'Notifikacija za isticanje zahteva za uslugu.',
            'succ_req' => 'Notifikacija za uspešan zahtev za uslugu.',
            'new_bid' => 'Notifikacija za novu ponudu na zahtev.',
            'upd_bid' => 'Notifikacija za izmenu ponude na zahtev.',
            'del_bid' => 'Notifikacija za brisanje ponude na zahtev.',
            'rej_bid' => 'Notifikacija za odbacivanje ponude na zahtev.',
            'rep_bid' => 'Notifikacija za prijavu ponude na zahtev.',
            'awa_bid' => 'Awa Bid',
            'exp_bid' => 'Notifikacija za isticanje ponude na zahtev.',
            'new_rev' => 'Notifikacija za novu recenziju.',
            'new_rate' => 'Notifikacija za novu ocenu.',
            'new_comm' => 'Notifikacija za novi komentar.',
            'new_rcmnd' => 'Notifikacija za novu preporuku.',
            'new_deal' => 'Notifikacija za novu promociju usluga.',
            'subs_deal' => 'Notifikacija za kupovinu promocije usluga.',
            'upd_deal' => 'Notifikacija za izmenu promocije usluga.',
            'exp_deal' => 'Notifikacija za isticanje promocije usluge.',
            'del_deal' => 'Notifikacija za brisanje promocije usluga.',
            'upd_memb' => 'Notifikacija za unapređenje članstva.',
            'exp_memb' => 'Notifikacija za isticanje članstva.',
            'jubilee' => 'Notifikacija za jubilej.',
            'update_time' => 'Datum i vreme izmene podešavanja za notifikacije.',
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
     * @return UserNotificationsQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new UserNotificationsQuery(get_called_class());
    }
}
