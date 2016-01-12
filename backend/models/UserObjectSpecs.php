<?php

namespace backend\models;

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
            'user_object_id' => 'User Object ID',
            'spec_id' => 'Spec ID',
            'value' => 'Value',
            'max' => 'Max',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUserObject()
    {
        return $this->hasOne(UserObjects::className(), ['id' => 'user_object_id']);
    }
}
