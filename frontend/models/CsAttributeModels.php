<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "cs_attribute_models".
 *
 * @property integer $id
 * @property string $name
 * @property integer $attribute_id
 * @property string $attribute
 * @property string $entry_by
 * @property string $entry_time
 * @property string $description
 *
 * @property CsAttributes $attribute0
 * @property User $entryBy
 * @property CsAttributeModelsTranslation[] $csAttributeModelsTranslations
 */
class CsAttributeModels extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'cs_attribute_models';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'attribute_id'], 'required'],
            [['attribute_id', 'entry_by'], 'integer'],
            [['entry_time'], 'safe'],
            [['description'], 'string'],
            [['name', 'attribute'], 'string', 'max' => 128]
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
            'attribute_id' => Yii::t('app', 'Attribute ID'),
            'attribute' => Yii::t('app', 'Attribute'),
            'entry_by' => Yii::t('app', 'Entry By'),
            'entry_time' => Yii::t('app', 'Entry Time'),
            'description' => Yii::t('app', 'Description'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAttribute0()
    {
        return $this->hasOne(CsAttributes::className(), ['id' => 'attribute_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getEntryBy()
    {
        return $this->hasOne(User::className(), ['id' => 'entry_by']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCsAttributeModelsTranslations()
    {
        return $this->hasMany(CsAttributeModelsTranslation::className(), ['attribute_model_id' => 'id']);
    }
}
