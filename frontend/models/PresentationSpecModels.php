<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "presentation_spec_models".
 *
 * @property string $id
 * @property string $presentation_spec_id
 * @property integer $spec_model
 * @property string $description
 */
class PresentationSpecModels extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'presentation_spec_models';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['presentation_spec_id', 'spec_model'], 'required'],
            [['presentation_spec_id', 'spec_model'], 'integer'],
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
            'presentation_spec_id' => Yii::t('app', 'Presentation Spec ID'),
            'spec_model' => Yii::t('app', 'Spec Model'),
            'description' => Yii::t('app', 'Description'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getModel()
    {
        return $this->hasOne(CsPropertyModels::className(), ['id' => 'spec_model']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPresentationSpec()
    {
        return $this->hasOne(PresentationSpecs::className(), ['id' => 'presentation_spec_id']);
    }    
}
