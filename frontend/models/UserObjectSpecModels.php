<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "user_object_spec_models".
 *
 * @property string $id
 * @property string $user_object_spec_id
 * @property integer $spec_model
 * @property string $description
 */
class UserObjectSpecModels extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'user_object_spec_models';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['user_object_spec_id', 'spec_model'], 'required'],
            [['user_object_spec_id', 'spec_model'], 'integer'],
            [['description'], 'string'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'user_object_spec_id' => Yii::t('app', 'User Object Spec ID'),
            'spec_model' => Yii::t('app', 'Spec Model'),
            'description' => Yii::t('app', 'Description'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUserObjectSpec()
    {
        return $this->hasOne(UserObjectSpecs::className(), ['id' => 'user_object_spec_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getModel()
    {
        return $this->hasOne(CsPropertyModels::className(), ['id' => 'spec_model']);
    }
}
