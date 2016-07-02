<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "provider_licences".
 *
 * @property string $id
 * @property string $provider_id
 * @property string $licence_no
 * @property integer $verification_code
 * @property string $verification_time
 * @property integer $verified
 */
class ProviderLicences extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'provider_licences';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['provider_id', 'licence_no'], 'required'],
            [['provider_id', 'verification_code', 'verified'], 'integer'],
            [['verification_time'], 'safe'],
            [['licence_no'], 'string', 'max' => 32],
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
            'licence_no' => Yii::t('app', 'Licence No'),
            'verification_code' => Yii::t('app', 'Verification Code'),
            'verification_time' => Yii::t('app', 'Verification Time'),
            'verified' => Yii::t('app', 'Verified'),
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
