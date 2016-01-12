<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "cs_regulations".
 *
 * @property integer $id
 * @property string $name
 * @property string $description
 *
 * @property CsRegulationsTranslation[] $csRegulationsTranslations
 * @property CsServiceRegulations[] $csServiceRegulations
 */
class CsRegulations extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'cs_regulations';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name'], 'required'],
            [['description'], 'string'],
            [['name'], 'string', 'max' => 32]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Zakonska regulativa.',
            'description' => 'Opis stavke.',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCsRegulationsTranslations()
    {
        return $this->hasMany(CsRegulationsTranslation::className(), ['regulation_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCsServiceRegulations()
    {
        return $this->hasMany(CsServiceRegulations::className(), ['regulation_id' => 'id']);
    }

    /**
     * @inheritdoc
     * @return CsRegulationsQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new CsRegulationsQuery(get_called_class());
    }
}
