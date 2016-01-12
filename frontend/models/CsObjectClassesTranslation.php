<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "cs_object_classes_translation".
 *
 * @property integer $id
 * @property integer $object_class_id
 * @property string $lang_code
 * @property string $name
 * @property string $orig_name
 * @property string $description
 *
 * @property CsLanguages $langCode
 * @property CsObjectClasses $objectClass
 */
class CsObjectClassesTranslation extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'cs_object_classes_translation';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['object_class_id', 'lang_code', 'name', 'orig_name'], 'required'],
            [['object_class_id'], 'integer'],
            [['description'], 'string'],
            [['lang_code'], 'string', 'max' => 2],
            [['name', 'orig_name'], 'string', 'max' => 50]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'object_class_id' => Yii::t('app', 'Object Class ID'),
            'lang_code' => Yii::t('app', 'Lang Code'),
            'name' => Yii::t('app', 'Name'),
            'orig_name' => Yii::t('app', 'Orig Name'),
            'description' => Yii::t('app', 'Description'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getLangCode()
    {
        return $this->hasOne(CsLanguages::className(), ['code' => 'lang_code']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getObjectClass()
    {
        return $this->hasOne(CsObjectClasses::className(), ['id' => 'object_class_id']);
    }
}
