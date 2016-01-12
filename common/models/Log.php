<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "log".
 *
 * @property string $id
 * @property string $activity_id
 * @property string $user_id
 * @property string $action
 * @property integer $marketed
 * @property string $time
 * @property string $opis
 *
 * @property Activities $activity
 * @property User $user
 */
class Log extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'log';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['activity_id', 'user_id', 'action', 'time'], 'required'],
            [['activity_id', 'user_id', 'marketed'], 'integer'],
            [['action', 'opis'], 'string'],
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
            'activity_id' => 'Stavka loga.',
            'user_id' => 'Korisnik loga.',
            'action' => 'Akcija loga.',
            'marketed' => 'Log prikazan na marketu: 0 - ne, 1 - da.',
            'time' => 'Vreme loga.',
            'opis' => 'Opis stavke loga.',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getActivity()
    {
        return $this->hasOne(Activities::className(), ['id' => 'activity_id']);
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
     * @return LogQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new LogQuery(get_called_class());
    }
}
