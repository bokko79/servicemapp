<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "user_recent".
 *
 * @property string $id
 * @property string $user_id
 * @property string $recent_type
 * @property string $recent_id
 * @property string $time
 *
 * @property User $user
 */
class UserRecent extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'user_recent';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['user_id', 'recent_type', 'recent_id', 'time'], 'required'],
            [['user_id', 'recent_id'], 'integer'],
            [['recent_type'], 'string'],
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
            'user_id' => 'Korisnik.',
            'recent_type' => 'Stavka koja je posećena. request - zahtev za uslugu; service - usluga; deal - promocija za uslugu; industry - uslužna delatnost; provider - pružalac usluge; object - predmet usluge; ',
            'recent_id' => 'ID stavke iz kolone recent_type',
            'time' => 'Datum i vreme posete stavke.',
        ];
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
     * @return UserRecentQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new UserRecentQuery(get_called_class());
    }
}
