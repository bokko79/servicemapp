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
            [['payment_type', 'exp_mnth', 'status'], 'string'],
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
            'id' => Yii::t('app', 'ID'),
            'user_id' => Yii::t('app', 'User ID'),
            'payment_type' => Yii::t('app', 'Payment Type'),
            'details' => Yii::t('app', 'Details'),
            'card_no' => Yii::t('app', 'Card No'),
            'exp_mnth' => Yii::t('app', 'Exp Mnth'),
            'exp_year' => Yii::t('app', 'Exp Year'),
            'scc' => Yii::t('app', 'Scc'),
            'first_name' => Yii::t('app', 'First Name'),
            'last_name' => Yii::t('app', 'Last Name'),
            'street' => Yii::t('app', 'Street'),
            'city' => Yii::t('app', 'City'),
            'zip' => Yii::t('app', 'Zip'),
            'country' => Yii::t('app', 'Country'),
            'status' => Yii::t('app', 'Status'),
            'time' => Yii::t('app', 'Time'),
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
