<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "provider_comments".
 *
 * @property string $id
 * @property string $provider_id
 * @property string $reviewer
 * @property string $text
 * @property string $status
 * @property string $time
 *
 * @property User $reviewer0
 * @property Provider $provider
 */
class ProviderComments extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'provider_comments';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['provider_id', 'reviewer', 'text', 'time'], 'required'],
            [['provider_id', 'reviewer'], 'integer'],
            [['text', 'status'], 'string'],
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
            'provider_id' => Yii::t('app', 'Provider ID'),
            'reviewer' => Yii::t('app', 'Reviewer'),
            'text' => Yii::t('app', 'Text'),
            'status' => Yii::t('app', 'Status'),
            'time' => Yii::t('app', 'Time'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getReviewer0()
    {
        return $this->hasOne(User::className(), ['id' => 'reviewer']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProvider()
    {
        return $this->hasOne(Provider::className(), ['id' => 'provider_id']);
    }
}
