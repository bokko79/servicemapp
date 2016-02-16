<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "cs_object_classes".
 *
 * @property integer $id
 * @property string $name
 * @property string $description
 * @property string $info
 * @property string $color
 * @property string $icon
 *
 * @property CsObjectClassesTranslation[] $csObjectClassesTranslations
 * @property CsObjectTypes[] $csObjectTypes
 */
class CsObjectClasses extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'cs_object_classes';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'color', 'icon'], 'required'],
            [['description', 'info'], 'string'],
            [['name'], 'string', 'max' => 30],
            [['color'], 'string', 'max' => 8],
            [['icon'], 'string', 'max' => 20]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Ime Klase predmeta usluge.',
            'description' => 'Opis Klase predmeta usluge.',
            'info' => 'Info Klase predmeta usluge.',
            'color' => 'Reprezentativna boja Klase predmeta usluge.',
            'icon' => 'Reprezentativna ikona Klase predmeta usluge (FontAwesome Icons).',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getT()
    {
        return $this->hasMany(CsObjectClassesTranslation::className(), ['object_class_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTypes()
    {
        return $this->hasMany(CsObjectTypes::className(), ['object_class_id' => 'id']);
    }

    /**
     * @inheritdoc
     * @return CsObjectClassesQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new CsObjectClassesQuery(get_called_class());
    }
}
