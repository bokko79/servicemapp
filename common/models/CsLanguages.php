<?php

namespace common\models;

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
            'id' => 'ID',
            'name' => 'Jezik.',
            'code' => 'Kod jezika.',
            'description' => 'Opis jezika.',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getActionsTranslations()
    {
        return $this->hasMany(CsActionsTranslation::className(), ['lang_code' => 'code']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAttributeModelsTranslations()
    {
        return $this->hasMany(CsAttributeModelsTranslation::className(), ['lang_code' => 'code']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAttributesTranslations()
    {
        return $this->hasMany(CsAttributesTranslation::className(), ['lang_code' => 'code']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCategoriesTranslations()
    {
        return $this->hasMany(CsCategoriesTranslation::className(), ['lang_code' => 'code']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIndustriesTranslations()
    {
        return $this->hasMany(CsIndustriesTranslation::className(), ['lang_code' => 'code']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getObjectClassesTranslations()
    {
        return $this->hasMany(CsObjectClassesTranslation::className(), ['lang_code' => 'code']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getObjectIssuesTranslations()
    {
        return $this->hasMany(CsObjectIssuesTranslation::className(), ['lang_code' => 'code']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getObjectTypesTranslations()
    {
        return $this->hasMany(CsObjectTypesTranslation::className(), ['lang_code' => 'code']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getObjectsTranslations()
    {
        return $this->hasMany(CsObjectsTranslation::className(), ['lang_code' => 'code']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProcessesTranslations()
    {
        return $this->hasMany(CsProcessesTranslation::className(), ['lang_code' => 'code']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRegulationsTranslations()
    {
        return $this->hasMany(CsRegulationsTranslation::className(), ['lang_code' => 'code']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSectorsTranslations()
    {
        return $this->hasMany(CsSectorsTranslation::className(), ['lang_code' => 'code']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getServicesTranslations()
    {
        return $this->hasMany(CsServicesTranslation::className(), ['lang_code' => 'code']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTags()
    {
        return $this->hasMany(CsTags::className(), ['lang_code' => 'code']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUnitsTranslations()
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
