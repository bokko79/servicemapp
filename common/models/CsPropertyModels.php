<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "cs_property_models".
 *
 * @property integer $id
 * @property string $name
 * @property integer $property_id
 * @property string $property
 * @property integer $selected_value 
 * @property string $hint 
 * @property string $image_id
 * @property string $entry_by
 * @property string $entry_time
 * @property string $description
 *
 * @property CsProperties $property
 * @property User $entryBy
 * @property CsPropertyModelsTranslation[] $csPropertyModelsTranslations
 */
class CsPropertyModels extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'cs_property_models';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'property_id'], 'required'],
            [['property_id', 'selected_value', 'image_id', 'entry_by'], 'integer'],
            [['entry_time'], 'safe'],
            [['description'], 'string'],
            [['name', 'property'], 'string', 'max' => 128],
            [['hint'], 'string', 'max' => 256],
            [['entry_by'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['entry_by' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Model svojstva.',
            'property_id' => 'ID svojstva.',
            'property' => 'Svojstvo.',
            'selected_value' => Yii::t('app', 'Selected Value'), 
            'hint' => Yii::t('app', 'Hint'), 
            'image_id' => Yii::t('app', 'Image ID'), 
            'entry_by' => 'Korisnik koji je uneo stavku.',
            'entry_time' => 'Entry Time',
            'description' => 'Opis modela svojstva.',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProperty()
    {
        return $this->hasOne(CsProperties::className(), ['id' => 'property_id']);
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
    public function getT()
    {
        return $this->hasMany(CsPropertyModelsTranslation::className(), ['property_model_id' => 'id']);
    }

    /**
     * @inheritdoc
     * @return CsPropertyModelsQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new CsPropertyModelsQuery(get_called_class());
    }
}
