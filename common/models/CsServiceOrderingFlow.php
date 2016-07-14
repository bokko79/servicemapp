<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "cs_service_ordering_flow".
 *
 * @property integer $service_id
 * @property integer $industry_properties
 * @property integer $object_container
 * @property integer $object_models
 * @property integer $object_properties
 * @property integer $object_files
 * @property integer $object_issues
 * @property integer $action_properties
 * @property integer $quantitites
 * @property integer $locations
 * @property integer $times
 * @property integer $budget
 * @property integer $advanced
 * @property integer $notifications
 * @property integer $terms
 */
class CsServiceOrderingFlow extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'cs_service_ordering_flow';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['service_id'], 'required'],
            [['service_id', 'industry_properties', 'object_container', 'object_models', 'object_properties', 'object_files', 'object_issues', 'action_properties', 'quantitites', 'locations', 'times', 'budget', 'advanced', 'notifications', 'terms'], 'integer'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'service_id' => Yii::t('app', 'Service ID'),
            'industry_properties' => Yii::t('app', 'Industry Properties'),
            'object_container' => Yii::t('app', 'Object Container'),
            'object_models' => Yii::t('app', 'Object Models'),
            'object_properties' => Yii::t('app', 'Object Properties'),
            'object_files' => Yii::t('app', 'Object Files'),
            'object_issues' => Yii::t('app', 'Object Issues'),
            'action_properties' => Yii::t('app', 'Action Properties'),
            'quantitites' => Yii::t('app', 'Quantitites'),
            'locations' => Yii::t('app', 'Locations'),
            'times' => Yii::t('app', 'Times'),
            'budget' => Yii::t('app', 'Budget'),
            'advanced' => Yii::t('app', 'Advanced'),
            'notifications' => Yii::t('app', 'Notifications'),
            'terms' => Yii::t('app', 'Terms'),
        ];
    }
}
