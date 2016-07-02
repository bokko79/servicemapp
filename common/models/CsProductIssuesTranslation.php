<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "cs_product_issues_translation".
 *
 * @property string $id
 * @property string $product_issue_id
 * @property string $lang_code
 * @property string $name
 * @property string $name_gen
 * @property string $name_dat
 * @property string $name_akk
 * @property string $orig_name
 * @property string $description
 */
class CsProductIssuesTranslation extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'cs_product_issues_translation';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['product_issue_id', 'lang_code', 'name', 'name_gen', 'name_dat', 'name_akk', 'orig_name'], 'required'],
            [['product_issue_id'], 'integer'],
            [['description'], 'string'],
            [['lang_code'], 'string', 'max' => 2],
            [['name', 'name_gen', 'name_dat', 'name_akk', 'orig_name'], 'string', 'max' => 128],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'product_issue_id' => Yii::t('app', 'Product Issue ID'),
            'lang_code' => Yii::t('app', 'Lang Code'),
            'name' => Yii::t('app', 'Name'),
            'name_gen' => Yii::t('app', 'Name Gen'),
            'name_dat' => Yii::t('app', 'Name Dat'),
            'name_akk' => Yii::t('app', 'Name Akk'),
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
    public function getProductIssue()
    {
        return $this->hasOne(CsProductIssues::className(), ['id' => 'product_issue_id']);
    }
}
