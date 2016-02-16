<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "cs_objects_translation".
 *
 * @property integer $id
 * @property integer $object_id
 * @property string $lang_code
 * @property string $name
 * @property string $name_gen
 * @property string $name_dat
 * @property string $name_akk
 * @property string $name_inst
 * @property string $orig_name
 * @property string $description
 *
 * @property CsLanguages $langCode
 * @property CsObjects $object
 */
class CsObjectsTranslation extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'cs_objects_translation';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['object_id', 'lang_code', 'name', 'name_gen', 'name_dat', 'name_akk', 'name_inst', 'orig_name', 'name_gender'], 'required'],
            [['object_id'], 'integer'],
            [['description'], 'string'],
            [['lang_code', 'name_gender'], 'string', 'max' => 2],
            [['name', 'name_gen', 'name_dat', 'name_akk', 'name_inst'], 'string', 'max' => 100],
            [['orig_name'], 'string', 'max' => 50],
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
            'object_id' => Yii::t('app', 'Object ID'),
            'lang_code' => Yii::t('app', 'Lang Code'),
            'name' => Yii::t('app', 'Name'),
            'name_gen' => Yii::t('app', 'Name Gen'), 
            'name_dat' => Yii::t('app', 'Name Dat'),
            'name_akk' => Yii::t('app', 'Name Akk'),
            'name_inst' => Yii::t('app', 'Name Inst'),
            'name_gender' => Yii::t('app', 'Name Gender'), 
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
    public function getObject()
    {
        return $this->hasOne(CsObjects::className(), ['id' => 'object_id']);
    }
}
