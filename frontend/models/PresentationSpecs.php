<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "presentation_specs".
 *
 * @property string $id
 * @property string $presentation_id
 * @property string $spec_id
 * @property string $value
 * @property string $value_max
* @property string $value_operator
 *
 * @property CsSpecs $spec
 * @property Presentations $presentation
 */
class PresentationSpecs extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'presentation_specs';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['presentation_id', 'spec_id'], 'required'],
            [['presentation_id', 'spec_id'], 'integer'],
            [['value_operator'], 'string'],
            [['value', 'value_max'], 'string', 'max' => 32],
            [['spec_id'], 'exist', 'skipOnError' => true, 'targetClass' => CsSpecs::className(), 'targetAttribute' => ['spec_id' => 'id']],
            [['presentation_id'], 'exist', 'skipOnError' => true, 'targetClass' => Presentations::className(), 'targetAttribute' => ['presentation_id' => 'id']],
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
           'spec_id' => Yii::t('app', 'Spec ID'),
           'value' => Yii::t('app', 'Value'),
           'value_max' => Yii::t('app', 'Value Max'),
           'value_operator' => Yii::t('app', 'Value Operator'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSpec()
    {
        return $this->hasOne(CsSpecs::className(), ['id' => 'spec_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPresentation()
    {
        return $this->hasOne(Presentations::className(), ['id' => 'presentation_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getModels()
    {
        return $this->hasMany(PresentationSpecModels::className(), ['presentation_id' => 'id']);
    }
}
