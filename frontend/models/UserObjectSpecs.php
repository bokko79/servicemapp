<?php

namespace frontend\models;

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
            'id' => Yii::t('app', 'ID'),
            'user_object_id' => Yii::t('app', 'User Object ID'),
            'spec_id' => Yii::t('app', 'Spec ID'),
            'value' => Yii::t('app', 'Value'),
            'max' => Yii::t('app', 'Max'),
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
