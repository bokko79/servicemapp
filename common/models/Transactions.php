<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "transactions".
 *
 * @property string $id
 * @property string $user_id
 * @property string $agreement_id
 * @property string $transaction_type
 * @property string $time
 *
 * @property User $user
 * @property Agreements $agreement
 */
class Transactions extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'transactions';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['user_id', 'agreement_id', 'transaction_type', 'time'], 'required'],
            [['user_id', 'agreement_id'], 'integer'],
            [['transaction_type'], 'string'],
            [['time'], 'safe']
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
            'agreement_id' => 'Transakcija.',
            'transaction_type' => 'Vrsta transakcije.',
            'time' => 'Datum i vreme transakcije.',
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
     * @return \yii\db\ActiveQuery
     */
    public function getAgreement()
    {
        return $this->hasOne(Agreements::className(), ['id' => 'agreement_id']);
    }

    /**
     * @inheritdoc
     * @return TransactionsQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new TransactionsQuery(get_called_class());
    }
}
