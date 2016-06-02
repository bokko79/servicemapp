<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "cs_object_types_translation".
 *
 * @property integer $id
 * @property integer $object_type_id
 * @property string $lang_code
 * @property string $name
 * @property string $orig_name
 * @property string $description
 *
 * @property CsObjectTypes $objectType
 * @property CsLanguages $langCode
 */
class CsObjectTypesTranslation extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'cs_object_types_translation';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['object_type_id', 'lang_code', 'name'], 'required'],
            [['object_type_id'], 'integer'],
            [['description'], 'string'],
            [['lang_code'], 'string', 'max' => 2],
            [['name'], 'string', 'max' => 100],
            [['orig_name'], 'string', 'max' => 50],
            [['object_type_id'], 'exist', 'skipOnError' => true, 'targetClass' => CsObjectTypes::className(), 'targetAttribute' => ['object_type_id' => 'id']],
            [['lang_code'], 'exist', 'skipOnError' => true, 'targetClass' => CsLanguages::className(), 'targetAttribute' => ['lang_code' => 'code']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'object_type_id' => Yii::t('app', 'Object Type ID'),
            'lang_code' => Yii::t('app', 'Lang Code'),
            'name' => Yii::t('app', 'Name'),
            'orig_name' => Yii::t('app', 'Orig Name'),
            'description' => Yii::t('app', 'Description'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getObjectType()
    {
        return $this->hasOne(CsObjectTypes::className(), ['id' => 'object_type_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getLangCode()
    {
        return $this->hasOne(CsLanguages::className(), ['code' => 'lang_code']);
    }
}
