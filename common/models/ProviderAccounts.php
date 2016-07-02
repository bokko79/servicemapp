<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "provider_accounts".
 *
 * @property integer $id
 * @property integer $provider_id
 * @property string $account_no
 * @property string $bank
 */
class ProviderAccounts extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'provider_accounts';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['provider_id', 'account_no', 'bank'], 'required'],
            [['provider_id'], 'integer'],
            [['account_no'], 'string', 'max' => 32],
            [['bank'], 'string', 'max' => 40],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'provider_id' => Yii::t('app', 'Provider ID'),
            'account_no' => Yii::t('app', 'Account No'),
            'bank' => Yii::t('app', 'Bank'),
        ];
    }
    
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProvider()
    {
        return $this->hasOne(Provider::className(), ['id' => 'provider_id']);
    }
}
