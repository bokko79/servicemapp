<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "user_details".
 *
 * @property string $user_id
 * @property string $loc_id
 * @property string $image_id
 * @property string $lang_code
 * @property integer $currency_id
 * @property integer $role_id
 * @property string $time_role_set
 * @property string $time_role_exp
 * @property string $Mcoin
 * @property integer $units
 * @property string $timezone
 * @property integer $ticker_status
 * @property string $DOB
 * @property string $gender
 * @property integer $score
 * @property integer $rate
 * @property integer $rating
 * @property string $update_time
 *
 * @property Roles $role
 * @property CsLanguages $langCode
 * @property Images $image
 * @property Locations $loc
 * @property CsCurrencies $currency
 * @property User $user
 */
class UserDetails extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'user_details';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['user_id', 'loc_id', 'time_role_set'], 'required'],
            [['user_id', 'loc_id', 'image_id', 'currency_id', 'role_id', 'Mcoin', 'units', 'ticker_status', 'score', 'rate', 'rating'], 'integer'],
            [['time_role_set', 'time_role_exp', 'DOB', 'update_time'], 'safe'],
            [['timezone', 'gender'], 'string'],
            [['lang_code'], 'string', 'max' => 2]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'user_id' => 'Korisnik.',
            'loc_id' => 'Primarna lokacija korisnika.',
            'image_id' => 'Avatar korisnika.',
            'lang_code' => 'Jezik korisnika.',
            'currency_id' => 'Valuta korisnika.',
            'role_id' => 'Članstvo korisnika.',
            'time_role_set' => 'Datum i vreme kad je postavljeno trenutno članstvo korisnika (iz kolone role_id).',
            'time_role_exp' => 'Datum i vreme do kada važi članstvo (iz kolone role_id).',
            'Mcoin' => 'Trenutno stanje na MAccount-u korisnika. Iznos u MCoin-ima.',
            'units' => 'Jedinice mere korisnika. 1 - metrics; 2 - imperial.',
            'timezone' => 'Vremenska zona korisnika.',
            'ticker_status' => 'Prikaz tickera u navbaru. 0 - isključen; 1 - uključen.',
            'DOB' => 'Datum rođenja korisnika.',
            'gender' => 'Pol korisnika.',
            'score' => 'Score korisnika.',
            'rate' => 'Ocena korisnika.',
            'rating' => 'Rejting korisnika.',
            'update_time' => 'Datum i vreme izmene profila ili naloga korisnika.',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRole()
    {
        return $this->hasOne(Roles::className(), ['id' => 'role_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getLangCode()
    {
        return $this->hasOne(CsLanguages::className(), ['code' => 'lang_code']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getImage()
    {
        return $this->hasOne(Images::className(), ['id' => 'image_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getLoc()
    {
        return $this->hasOne(Locations::className(), ['id' => 'loc_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCurrency()
    {
        return $this->hasOne(CsCurrencies::className(), ['id' => 'currency_id']);
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
     * @return UserDetailsQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new UserDetailsQuery(get_called_class());
    }
}
