<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "presentation_methods".
 *
 * @property string $id
 * @property string $presentation_id
 * @property integer $method_id
 * @property string $value
 * @property string $value_max
 *
 * @property CsMethods $method
 * @property Presentations $presentation
 */
class PresentationMethods extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'presentation_methods';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['presentation_id', 'method_id'], 'required'],
            [['presentation_id', 'method_id'], 'integer'],
            [['value', 'value_max'], 'string', 'max' => 64],
            [['method_id'], 'exist', 'skipOnError' => true, 'targetClass' => CsMethods::className(), 'targetAttribute' => ['method_id' => 'id']],
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
            'method_id' => 'Method ID',
            'value' => 'Value',
            'value_max' => 'Value Max',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMethod()
    {
        return $this->hasOne(CsMethods::className(), ['id' => 'method_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPresentation()
    {
        return $this->hasOne(Presentations::className(), ['id' => 'presentation_id']);
    }
}
