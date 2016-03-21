<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "presentation_object_models".
 *
 * @property string $id
 * @property string $presentation_id
 * @property integer $object_model_id
 * @property string $description
 */
class PresentationObjectModels extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'presentation_object_models';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['presentation_id', 'object_model_id'], 'required'],
            [['presentation_id', 'object_model_id'], 'integer'],
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
            'presentation_id' => Yii::t('app', 'Presentation ID'),
            'object_model_id' => Yii::t('app', 'Object Model ID'),
            'description' => Yii::t('app', 'Description'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getObject()
    {
        return $this->hasOne(CsObjects::className(), ['id' => 'object_model_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPresentation()
    {
        return $this->hasOne(Presentations::className(), ['id' => 'presentation_id']);
    }
}
