<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "cs_services_translation".
 *
 * @property string $id
 * @property integer $service_id
 * @property string $lang_code
 * @property string $name
 * @property string $orig_name
 * @property string $note
 * @property string $subnote
 * @property string $description
 *
 * @property CsLanguages $langCode
 * @property CsServices $service
 */
class CsServicesTranslation extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'cs_services_translation';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['service_id', 'lang_code', 'name'], 'required'],
            [['service_id'], 'integer'],
            [['note', 'subnote', 'description'], 'string'],
            [['lang_code'], 'string', 'max' => 2],
            [['name', 'name_gen', 'name_dat', 'name_akk'], 'string', 'max' => 100],
            [['hint_order', 'hint_presentation'], 'string', 'max' => 128],
            [['orig_name'], 'string', 'max' => 90],
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
            'service_id' => Yii::t('app', 'Service ID'),
            'lang_code' => Yii::t('app', 'Lang Code'),
            'name' => Yii::t('app', 'Name'),
            'orig_name' => Yii::t('app', 'Orig Name'),
            'note' => Yii::t('app', 'Note'),
            'subnote' => Yii::t('app', 'Subnote'),
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
    public function getService()
    {
        return $this->hasOne(CsServices::className(), ['id' => 'service_id']);
    }
}
