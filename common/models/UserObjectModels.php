<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "user_object_models".
 *
 * @property string $id
 * @property string $user_object_id
 * @property string $object_model_id
 */
class UserObjectModels extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'user_object_models';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['user_object_id', 'object_model_id'], 'required'],
            [['user_object_id', 'object_model_id'], 'integer'],
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
            'object_model_id' => Yii::t('app', 'Object Model ID'),
        ];
    }
}
