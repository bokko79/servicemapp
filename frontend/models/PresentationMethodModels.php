<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "presentation_method_models".
 *
 * @property string $id
 * @property string $presentation_method_id
 * @property integer $method_model
 * @property string $description
 */
class PresentationMethodModels extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'presentation_method_models';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['presentation_method_id', 'method_model'], 'required'],
            [['presentation_method_id', 'method_model'], 'integer'],
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
            'presentation_method_id' => Yii::t('app', 'Presentation Method ID'),
            'method_model' => Yii::t('app', 'Method Model'),
            'description' => Yii::t('app', 'Description'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getModel()
    {
        return $this->hasOne(CsPropertyModels::className(), ['id' => 'method_model']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPresentationSpec()
    {
        return $this->hasOne(PresentationMethods::className(), ['id' => 'presentation_method_id']);
    }
}
