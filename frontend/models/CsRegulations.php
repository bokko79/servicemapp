<?php

namespace frontend\models;

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
            'id' => Yii::t('app', 'ID'),
            'name' => Yii::t('app', 'Name'),
            'description' => Yii::t('app', 'Description'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getT()
    {
        return $this->hasMany(CsRegulationsTranslation::className(), ['regulation_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getServiceRegulations()
    {
        return $this->hasMany(CsServiceRegulations::className(), ['regulation_id' => 'id']);
    }
}
