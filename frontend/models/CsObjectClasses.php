<?php

namespace frontend\models;

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
            'id' => Yii::t('app', 'ID'),
            'name' => Yii::t('app', 'Name'),
            'description' => Yii::t('app', 'Description'),
            'info' => Yii::t('app', 'Info'),
            'color' => Yii::t('app', 'Color'),
            'icon' => Yii::t('app', 'Icon'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCsObjectClassesTranslations()
    {
        return $this->hasMany(CsObjectClassesTranslation::className(), ['object_class_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCsObjectTypes()
    {
        return $this->hasMany(CsObjectTypes::className(), ['object_class_id' => 'id']);
    }
}
