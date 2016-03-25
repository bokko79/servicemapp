<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "provider_notifications".
 *
 * @property integer $provider_id
 * @property string $notification_type
 * @property string $time
 * @property string $description
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
            [['notification_type', 'description'], 'string'],
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
            'description' => Yii::t('app', 'Description'),
        ];
    }
}
