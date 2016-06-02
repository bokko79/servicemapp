<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "cs_objects_translation".
 *
 * @property integer $id
 * @property string $object_id
 * @property string $lang_code
 * @property string $name
 * @property string $name_gen
 * @property string $name_dat
 * @property string $name_akk
 * @property string $name_inst
 * @property string $name_pl
 * @property string $name_pl_gen
 * @property string $name_gender
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
            [['object_id', 'lang_code', 'name', 'name_gen', 'name_dat', 'name_akk', 'name_inst', 'orig_name'], 'required'],
            [['object_id'], 'integer'],
            [['name_gender', 'description'], 'string'],
            [['lang_code'], 'string', 'max' => 2],
            [['name', 'name_gen', 'name_dat', 'name_akk', 'name_inst', 'name_pl', 'name_pl_gen'], 'string', 'max' => 100],
            [['orig_name'], 'string', 'max' => 50],
            [['hint'], 'string', 'max' => 256],
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
            'name_pl' => Yii::t('app', 'Name Pl'),
            'name_pl_gen' => Yii::t('app', 'Name Pl Gen'),
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
