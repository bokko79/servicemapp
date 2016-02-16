<?php

namespace common\models;

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
            [['object_id', 'lang_code', 'name', 'name_gen', 'name_dat', 'name_akk', 'name_inst', 'orig_name'], 'required'],
            [['object_id'], 'integer'],
            [['description'], 'string'],
            [['lang_code'], 'string', 'max' => 2],
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
            'id' => 'ID',
            'object_id' => 'Predmet usluge.',
            'lang_code' => 'Jezik.',
            'name' => 'Prevod imena predmeta usluge.',
            'name_gen' => Yii::t('app', 'Name Gen'), 
            'name_dat' => 'Ime u dativu (kome?čemu?).',
            'name_akk' => 'Ime u akuzativu (koga?šta?).',
            'name_inst' => 'Ime u instrumentalu (s kim, čime).',
            'orig_name' => 'Originalno ime predmeta usluge (iz tabele objects).',
            'description' => 'Opis stavke.',
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

    /**
     * @inheritdoc
     * @return CsObjectsTranslationQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new CsObjectsTranslationQuery(get_called_class());
    }
}
