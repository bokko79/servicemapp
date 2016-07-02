<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "provider_contact".
 *
 * @property integer $id
 * @property integer $provider_id
 * @property string $contact_type
 * @property string $value
 * @property string $verification_code
 * @property string $verification_time
 * @property integer $verified
 */
class ProviderContact extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'provider_contact';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['provider_id', 'contact_type', 'value'], 'required'],
            [['provider_id', 'verified'], 'integer'],
            [['contact_type'], 'string'],
            [['verification_time'], 'safe'],
            [['value'], 'string', 'max' => 40],
            [['verification_code'], 'string', 'max' => 4],
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
            'contact_type' => Yii::t('app', 'Contact Type'),
            'value' => Yii::t('app', 'Value'),
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
