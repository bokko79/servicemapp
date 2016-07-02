<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "provider_notifications".
 *
 * @property integer $provider_id
 * @property string $notification_type
 * @property string $time
 */
class ProviderNotifications extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'provider_notifications';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['provider_id', 'time'], 'required'],
            [['provider_id'], 'integer'],
            [['notification_type'], 'string'],
            [['time'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'provider_id' => Yii::t('app', 'Provider ID'),
            'notification_type' => Yii::t('app', 'Notification Type'),
            'time' => Yii::t('app', 'Time'),
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
