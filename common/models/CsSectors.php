<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "cs_sectors".
 *
 * @property integer $id
 * @property string $name
 * @property string $description
 * @property string $info
 * @property string $color
 * @property string $icon
 *
 * @property CsCategories[] $csCategories
 * @property CsSectorsTranslation[] $csSectorsTranslations
 */
class CsSectors extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'cs_sectors';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'description'], 'required'],
            [['description', 'info'], 'string'],
            [['name'], 'string', 'max' => 50],
            [['color'], 'string', 'max' => 8],
            [['icon'], 'string', 'max' => 17]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Ime sektora usluge.',
            'description' => 'Opis sektora usluge.',
            'info' => 'Info sektora usluge.',
            'color' => 'Reprezentativna boja sektora usluge.',
            'icon' => 'Reprezentativna ikona sektora usluge (FontAwesome Icons).',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCategories()
    {
        return $this->hasMany(CsCategories::className(), ['sector_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getT()
    {
        return $this->hasMany(CsSectorsTranslation::className(), ['sector_id' => 'id']);
    }

    /**
     * @inheritdoc
     * @return CsSectorsQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new CsSectorsQuery(get_called_class());
    }
}
