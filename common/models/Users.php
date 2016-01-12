<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "users".
 *
 * @property string $id
 * @property string $username
 * @property string $password
 * @property string $password_hash
 * @property string $password_token
 * @property string $password_reset_time
 * @property string $user_email
 * @property string $email_reset_hash
 * @property string $email_reset_time
 * @property string $fullname
 * @property integer $is_provider
 * @property string $ip_address
 * @property string $registration_time
 * @property string $activation_hash
 * @property string $activation_time
 * @property string $invite_hash
 * @property string $registered_by
 * @property integer $type
 * @property integer $status
 * @property string $status_update_time
 * @property string $last_login_time
 * @property string $login_count
 * @property string $login_hash
 * @property integer $online_status
 * @property integer $last_activity
 * @property string $phone
 * @property string $phone_verification_hash
 * @property string $phone_verification_time
 * @property string $rememberme_token
 * @property string $role_code
 * @property integer $failed_logins
 * @property string $last_failed_login
 * @property string $facebook_uid
 * @property string $google_uid
 * @property string $twitter_uid
 * @property string $linkedin_uid
 *
 * @property Users $registeredBy
 * @property Users[] $users
 */
class Users extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'users';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['username', 'password', 'password_token', 'user_email'], 'required'],
            [['password_reset_time', 'email_reset_time', 'registration_time', 'activation_time', 'status_update_time', 'last_login_time', 'phone_verification_time'], 'safe'],
            [['is_provider', 'registered_by', 'type', 'status', 'login_count', 'online_status', 'last_activity', 'failed_logins'], 'integer'],
            [['rememberme_token', 'last_failed_login', 'facebook_uid', 'google_uid', 'twitter_uid', 'linkedin_uid'], 'string'],
            [['username'], 'string', 'max' => 16],
            [['password', 'password_hash', 'email_reset_hash', 'fullname', 'activation_hash', 'invite_hash', 'login_hash'], 'string', 'max' => 32],
            [['password_token', 'role_code'], 'string', 'max' => 13],
            [['user_email'], 'string', 'max' => 64],
            [['ip_address'], 'string', 'max' => 45],
            [['phone'], 'string', 'max' => 24],
            [['phone_verification_hash'], 'string', 'max' => 4]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'username' => 'Korisničko ime.',
            'password' => 'Lozinka korisnika. Kriptovana.',
            'password_hash' => 'Hash za resetovanje lozinke.',
            'password_token' => 'Pomoćni kod za resetovanje lozinke.',
            'password_reset_time' => 'Datum i vreme resetovanja lozinke.',
            'user_email' => 'E-mail adresa korisnika.',
            'email_reset_hash' => 'Hash za resetovanje e-mail adrese.',
            'email_reset_time' => 'Datum i vreme resetovanja e-mail adrese korisnika.',
            'fullname' => 'Puno ime/poslovno ime korisnika.',
            'is_provider' => 'Korisnik je pružalac usluge. 0 - redovan korisnik; 1 - korisnik je pružalac usluge. ',
            'ip_address' => 'IP adresa korisnika pri registraciji.',
            'registration_time' => 'Datum i vreme registracije korisnika.',
            'activation_hash' => 'Aktivacioni kod, potreban za aktivaciju naloga putem e-maila.',
            'activation_time' => 'Datum i vreme aktivacije naloga.',
            'invite_hash' => 'Kod za pozivanje drugih korisnika. MLM invite system.',
            'registered_by' => 'ID korisnika-akvizitera preko kojeg se korisnik registrovao. MLM invite system.',
            'type' => 'Vrsta korisnika. 1 - redovan korisnik.',
            'status' => 'Status korisnika. 0 - nekativan; 1 - aktivan; 2 - mirovanje.',
            'status_update_time' => 'Datum i vreme promene statusa naloga korisnika.',
            'last_login_time' => 'Datum i vreme poslednjeg logovanja (prijave) korisnika.',
            'login_count' => 'Broj logovanja (prijava) korisnika.',
            'login_hash' => 'Pomoćni kod za logovanje korisnika.',
            'online_status' => 'Online status korisnika.',
            'last_activity' => 'Vreme time() od poslednje aktivnosti.',
            'phone' => 'Primarni broj mobilnog telefona korisnika. Koristi se i za SMS notifikacije,',
            'phone_verification_hash' => 'Kod za potvrdu broja mobilnog telefona, koji se šalje putem SMS-a na broj iz kolone \"phone\".',
            'phone_verification_time' => 'Datum i vreme potvrde broja telefona korisnika.',
            'rememberme_token' => 'Kod za cookie \"zapamti me\", za automatsku prijavu korisnika.',
            'role_code' => 'Kod za podešavanje članarine.',
            'failed_logins' => 'Broj uzastopnih neuspešnih logovanja (prijava).',
            'last_failed_login' => 'Poslednje neuspešno logovanje (prijava) korisnika.',
            'facebook_uid' => 'OAuth via Facebook.',
            'google_uid' => 'OAuth via Google.',
            'twitter_uid' => 'OAuth via Twitter.',
            'linkedin_uid' => 'OAuth via LinkedIn.',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRegisteredBy()
    {
        return $this->hasOne(Users::className(), ['id' => 'registered_by']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUsers()
    {
        return $this->hasMany(Users::className(), ['registered_by' => 'id']);
    }

    /**
     * @inheritdoc
     * @return UsersQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new UsersQuery(get_called_class());
    }
}
