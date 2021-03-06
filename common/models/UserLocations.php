<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "user_locations".
 *
 * @property string $id
 * @property string $user_id
 * @property string $loc_id
 * @property string $ime
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
            [['ime'], 'string', 'max' => 25]
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
            'loc_id' => Yii::t('app', 'Loc ID'),
            'ime' => Yii::t('app', 'Ime'),
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
