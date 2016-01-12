<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "cs_regulations_translation".
 *
 * @property integer $id
 * @property integer $regulation_id
 * @property string $lang_code
 * @property string $name
 * @property string $orig_name
 * @property string $description
 * @property string $body
 *
 * @property CsRegulations $regulation
 * @property CsLanguages $langCode
 */
class CsRegulationsTranslation extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'cs_regulations_translation';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['regulation_id', 'lang_code', 'name', 'orig_name', 'body'], 'required'],
            [['regulation_id'], 'integer'],
            [['description', 'body'], 'string'],
            [['lang_code'], 'string', 'max' => 2],
            [['name'], 'string', 'max' => 48],
            [['orig_name'], 'string', 'max' => 32]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'regulation_id' => Yii::t('app', 'Regulation ID'),
            'lang_code' => Yii::t('app', 'Lang Code'),
            'name' => Yii::t('app', 'Name'),
            'orig_name' => Yii::t('app', 'Orig Name'),
            'description' => Yii::t('app', 'Description'),
            'body' => Yii::t('app', 'Body'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRegulation()
    {
        return $this->hasOne(CsRegulations::className(), ['id' => 'regulation_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getLangCode()
    {
        return $this->hasOne(CsLanguages::className(), ['code' => 'lang_code']);
    }
}
