<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "cs_languages".
 *
 * @property integer $id
 * @property string $name
 * @property string $code
 * @property string $description
 *
 * @property CsActionsTranslation[] $csActionsTranslations
 * @property CsAttributeModelsTranslation[] $csAttributeModelsTranslations
 * @property CsAttributesTranslation[] $csAttributesTranslations
 * @property CsCategoriesTranslation[] $csCategoriesTranslations
 * @property CsIndustriesTranslation[] $csIndustriesTranslations
 * @property CsObjectClassesTranslation[] $csObjectClassesTranslations
 * @property CsObjectIssuesTranslation[] $csObjectIssuesTranslations
 * @property CsObjectTypesTranslation[] $csObjectTypesTranslations
 * @property CsObjectsTranslation[] $csObjectsTranslations
 * @property CsProcessesTranslation[] $csProcessesTranslations
 * @property CsRegulationsTranslation[] $csRegulationsTranslations
 * @property CsSectorsTranslation[] $csSectorsTranslations
 * @property CsServicesTranslation[] $csServicesTranslations
 * @property CsTags[] $csTags
 * @property CsUnitsTranslation[] $csUnitsTranslations
 * @property Orders[] $orders
 * @property PostCategoryTranslation[] $postCategoryTranslations
 * @property PostTranslation[] $postTranslations
 * @property ProviderLanguages[] $providerLanguages
 * @property UserDetails[] $userDetails
 */
class CsLanguages extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'cs_languages';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name'], 'required'],
            [['description'], 'string'],
            [['name'], 'string', 'max' => 50],
            [['code'], 'string', 'max' => 2],
            [['code'], 'unique']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'name' => Yii::t('app', 'Name'),
            'code' => Yii::t('app', 'Code'),
            'description' => Yii::t('app', 'Description'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCsActionsTranslations()
    {
        return $this->hasMany(CsActionsTranslation::className(), ['lang_code' => 'code']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCsAttributeModelsTranslations()
    {
        return $this->hasMany(CsAttributeModelsTranslation::className(), ['lang_code' => 'code']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCsAttributesTranslations()
    {
        return $this->hasMany(CsAttributesTranslation::className(), ['lang_code' => 'code']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCsCategoriesTranslations()
    {
        return $this->hasMany(CsCategoriesTranslation::className(), ['lang_code' => 'code']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCsIndustriesTranslations()
    {
        return $this->hasMany(CsIndustriesTranslation::className(), ['lang_code' => 'code']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCsObjectClassesTranslations()
    {
        return $this->hasMany(CsObjectClassesTranslation::className(), ['lang_code' => 'code']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCsObjectIssuesTranslations()
    {
        return $this->hasMany(CsObjectIssuesTranslation::className(), ['lang_code' => 'code']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCsObjectTypesTranslations()
    {
        return $this->hasMany(CsObjectTypesTranslation::className(), ['lang_code' => 'code']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCsObjectsTranslations()
    {
        return $this->hasMany(CsObjectsTranslation::className(), ['lang_code' => 'code']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCsProcessesTranslations()
    {
        return $this->hasMany(CsProcessesTranslation::className(), ['lang_code' => 'code']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCsRegulationsTranslations()
    {
        return $this->hasMany(CsRegulationsTranslation::className(), ['lang_code' => 'code']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCsSectorsTranslations()
    {
        return $this->hasMany(CsSectorsTranslation::className(), ['lang_code' => 'code']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCsServicesTranslations()
    {
        return $this->hasMany(CsServicesTranslation::className(), ['lang_code' => 'code']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCsTags()
    {
        return $this->hasMany(CsTags::className(), ['lang_code' => 'code']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCsUnitsTranslations()
    {
        return $this->hasMany(CsUnitsTranslation::className(), ['lang_code' => 'code']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getOrders()
    {
        return $this->hasMany(Orders::className(), ['lang_code' => 'code']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPostCategoryTranslations()
    {
        return $this->hasMany(PostCategoryTranslation::className(), ['lang_code' => 'code']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPostTranslations()
    {
        return $this->hasMany(PostTranslation::className(), ['lang_code' => 'code']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProviderLanguages()
    {
        return $this->hasMany(ProviderLanguages::className(), ['lang_code' => 'code']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUserDetails()
    {
        return $this->hasMany(UserDetails::className(), ['lang_code' => 'code']);
    }
}
