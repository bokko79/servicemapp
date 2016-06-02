<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "cs_object_parts_translation".
 *
 * @property string $id
 * @property string $object_part_id
 * @property string $lang_code
 * @property string $name
 * @property string $name_gen
 * @property string $name_dat
 * @property string $name_akk
 * @property string $orig_name
 * @property string $description
 */
class CsObjectPartsTranslation extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'cs_object_parts_translation';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['object_part_id', 'lang_code', 'name', 'name_gen', 'name_dat', 'name_akk', 'orig_name'], 'required'],
            [['object_part_id'], 'integer'],
            [['description'], 'string'],
            [['lang_code'], 'string', 'max' => 2],
            [['name', 'name_gen', 'name_dat', 'name_akk', 'orig_name'], 'string', 'max' => 100],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'object_part_id' => Yii::t('app', 'Object Part ID'),
            'lang_code' => Yii::t('app', 'Lang Code'),
            'name' => Yii::t('app', 'Name'),
            'name_gen' => Yii::t('app', 'Name Gen'),
            'name_dat' => Yii::t('app', 'Name Dat'),
            'name_akk' => Yii::t('app', 'Name Akk'),
            'orig_name' => Yii::t('app', 'Orig Name'),
            'description' => Yii::t('app', 'Description'),
        ];
    }
}
