<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "cs_attributes".
 *
 * @property integer $id
 * @property string $name
 * @property integer $unit_id
 * @property string $mark
 * @property string $description
 *
 * @property CsAttributeModels[] $csAttributeModels
 * @property CsUnits $unit
 * @property CsAttributesTranslation[] $csAttributesTranslations
 * @property CsMethods[] $csMethods
 * @property CsSkills[] $csSkills
 * @property CsSpecs[] $csSpecs
 */
class CsAttributes extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'cs_attributes';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name'], 'required'],
            [['unit_id'], 'integer'],
            [['name'], 'string', 'max' => 64],
            [['mark'], 'string', 'max' => 10],
            [['description'], 'string', 'max' => 32]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'name' => Yii::t('app', 'Name'),
            'unit_id' => Yii::t('app', 'Unit ID'),
            'mark' => Yii::t('app', 'Mark'),
            'description' => Yii::t('app', 'Description'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCsAttributeModels()
    {
        return $this->hasMany(CsAttributeModels::className(), ['attribute_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUnit()
    {
        return $this->hasOne(CsUnits::className(), ['id' => 'unit_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCsAttributesTranslations()
    {
        return $this->hasMany(CsAttributesTranslation::className(), ['attribute_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCsMethods()
    {
        return $this->hasMany(CsMethods::className(), ['attribute_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCsSkills()
    {
        return $this->hasMany(CsSkills::className(), ['attribute_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCsSpecs()
    {
        return $this->hasMany(CsSpecs::className(), ['attribute_id' => 'id']);
    }
}
