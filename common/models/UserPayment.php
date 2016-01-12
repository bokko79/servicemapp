<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "user_payment".
 *
 * @property integer $id
 * @property string $user_id
 * @property string $payment_type
 * @property string $details
 * @property string $card_no
 * @property string $exp_mnth
 * @property string $exp_year
 * @property string $scc
 * @property string $first_name
 * @property string $last_name
 * @property string $street
 * @property string $city
 * @property string $zip
 * @property string $country
 * @property string $status
 * @property string $time
 * @property string $opis
 *
 * @property User $user
 */
class UserPayment extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'user_payment';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['user_id', 'payment_type', 'card_no', 'exp_mnth', 'exp_year', 'scc', 'first_name', 'last_name', 'country', 'time'], 'required'],
            [['user_id'], 'integer'],
            [['payment_type', 'exp_mnth', 'status', 'opis'], 'string'],
            [['exp_year', 'time'], 'safe'],
            [['details', 'first_name'], 'string', 'max' => 20],
            [['card_no'], 'string', 'max' => 16],
            [['scc'], 'string', 'max' => 3],
            [['last_name', 'street', 'city', 'country'], 'string', 'max' => 32],
            [['zip'], 'string', 'max' => 10]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'user_id' => 'Korisnik.',
            'payment_type' => 'Vrsta plaćanja.',
            'details' => 'Detalji kartice/računa.',
            'card_no' => 'Broj kreditne kartice.',
            'exp_mnth' => 'Mesec kada ističe kartica.',
            'exp_year' => 'Godina kada ističe kartica.',
            'scc' => 'Security Code',
            'first_name' => 'Ime vlasnika kartice.',
            'last_name' => 'Prezime vlasnika kartice.',
            'street' => 'Ulica vlasnika kartice.',
            'city' => 'Grad vlasnika kartice.',
            'zip' => 'Poštanski broj vl kartice.',
            'country' => 'Država vlasnika kartice.',
            'status' => 'Status kartice/načina plaćanja. active - aktivan; inactive - neaktivan; banned - zabranjen.',
            'time' => 'Datum i vreme unosa načina plaćanja.',
            'opis' => 'Opis stavke.',
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
     * @return UserPaymentQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new UserPaymentQuery(get_called_class());
    }
}
