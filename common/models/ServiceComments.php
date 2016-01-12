<?php

namespace common\models;

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
            'id' => 'ID',
            'user_id' => 'Korisnik koji postavlja komentar - komentator.',
            'service_id' => 'Usluga, za koju se postavlja komentar.',
            'text' => 'Tekst komentara.',
            'status' => 'Status komentara.',
            'time' => 'Datum i vreme komentara.',
            'opis' => 'Opis stavke.',
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

    /**
     * @inheritdoc
     * @return ServiceCommentsQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new ServiceCommentsQuery(get_called_class());
    }
}
