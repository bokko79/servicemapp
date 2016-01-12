<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "user_object_specs".
 *
 * @property string $id
 * @property string $user_object_id
 * @property string $spec_id
 * @property string $value
 * @property string $max
 *
 * @property UserObjects $userObject
 */
class UserObjectSpecs extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'user_object_specs';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['user_object_id', 'spec_id', 'value'], 'required'],
            [['user_object_id', 'spec_id'], 'integer'],
            [['value', 'max'], 'string', 'max' => 64]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'user_object_id' => 'Korisnikov predmet usluge.',
            'spec_id' => 'Atribut.',
            'value' => 'Vrednost atributa korisnikovog predmeta usluge.',
            'max' => 'Maksimalna vrednost.',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUserObject()
    {
        return $this->hasOne(UserObjects::className(), ['id' => 'user_object_id']);
    }

    /**
     * @inheritdoc
     * @return UserObjectSpecsQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new UserObjectSpecsQuery(get_called_class());
    }
}
