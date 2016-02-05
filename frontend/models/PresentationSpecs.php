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
 * @property string $max
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
            [['value', 'max'], 'string', 'max' => 32],
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
            'id' => 'ID',
            'presentation_id' => 'Presentation ID',
            'spec_id' => 'Spec ID',
            'value' => 'Value',
            'max' => 'Max',
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
}
