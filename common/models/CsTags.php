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
            [['entity'], 'string'],
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
            'id' => Yii::t('app', 'ID'),
            'entity' => Yii::t('app', 'Entity'),
            'entity_id' => Yii::t('app', 'Entity ID'),
            'lang_code' => Yii::t('app', 'Lang Code'),
            'tag' => Yii::t('app', 'Tag'),
            'orig_name' => Yii::t('app', 'Orig Name'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getLangCode()
    {
        return $this->hasOne(CsLanguages::className(), ['code' => 'lang_code']);
    }
}
