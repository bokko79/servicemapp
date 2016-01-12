<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "user_locations".
 *
 * @property string $id
 * @property string $user_id
 * @property string $loc_id
 * @property string $ime
 * @property string $opis
 *
 * @property Locations $loc
 * @property User $user
 */
class UserLocations extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'user_locations';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['user_id', 'loc_id'], 'required'],
            [['user_id', 'loc_id'], 'integer'],
            [['opis'], 'string'],
            [['ime'], 'string', 'max' => 25]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'user_id' => 'User ID',
            'loc_id' => 'Loc ID',
            'ime' => 'Ime',
            'opis' => 'Opis',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getLoc()
    {
        return $this->hasOne(Locations::className(), ['id' => 'loc_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }
}
