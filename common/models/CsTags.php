<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "cs_tags".
 *
 * @property string $id
 * @property string $entity
 * @property string $entity_id
 * @property string $lang_code
 * @property string $tag
 * @property string $orig_name
 * @property string $description
 *
 * @property CsLanguages $langCode
 */
class CsTags extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'cs_tags';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['entity', 'entity_id', 'lang_code', 'tag', 'orig_name'], 'required'],
            [['entity', 'description'], 'string'],
            [['entity_id'], 'integer'],
            [['lang_code'], 'string', 'max' => 2],
            [['tag', 'orig_name'], 'string', 'max' => 64]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'entity' => 'Entitet koji se taguje.',
            'entity_id' => 'ID entiteta koji se taguje.',
            'lang_code' => 'Jezik.',
            'tag' => 'Prevod taga (sinonima) entiteta.',
            'orig_name' => 'Originalno ime entiteta.',
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
     * @inheritdoc
     * @return CsTagsQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new CsTagsQuery(get_called_class());
    }
}
