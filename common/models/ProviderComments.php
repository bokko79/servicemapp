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
            'id' => 'ID',
            'provider_id' => 'Korisnik (pružalac usluge) koji je recenzionisan.',
            'reviewer' => 'Korisnik koji piše recenziju.',
            'text' => 'Tekst recenzije.',
            'status' => 'Status recenzije.',
            'time' => 'Datum i vreme recenzije.',
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

    /**
     * @inheritdoc
     * @return ProviderCommentsQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new ProviderCommentsQuery(get_called_class());
    }
}
