<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "service_comments".
 *
 * @property string $id
 * @property string $user_id
 * @property integer $service_id
 * @property string $text
 * @property string $status
 * @property string $time
 * @property string $opis
 *
 * @property CsServices $service
 * @property User $user
 */
class ServiceComments extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'service_comments';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['user_id', 'service_id', 'text', 'time'], 'required'],
            [['user_id', 'service_id'], 'integer'],
            [['text', 'status', 'opis'], 'string'],
            [['time'], 'safe']
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
            'service_id' => Yii::t('app', 'Service ID'),
            'text' => Yii::t('app', 'Text'),
            'status' => Yii::t('app', 'Status'),
            'time' => Yii::t('app', 'Time'),
            'opis' => Yii::t('app', 'Opis'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getService()
    {
        return $this->hasOne(CsServices::className(), ['id' => 'service_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }
}
