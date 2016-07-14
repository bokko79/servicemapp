<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "presentation_checklist".
 *
 * @property string $presentation_id
 * @property integer $industry_properties
 * @property integer $object_container
 * @property integer $object_models
 * @property integer $object_properties
 * @property integer $object_files
 * @property integer $object_issues
 * @property integer $action_properties
 * @property integer $locations
 * @property integer $pricing
 * @property integer $quantities
 * @property integer $times
 * @property integer $advanced
 * @property integer $notifications
 * @property integer $terms
 */
class PresentationChecklist extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'presentation_checklist';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['presentation_id'], 'required'],
            [['presentation_id', 'industry_properties', 'object_container', 'object_models', 'object_properties', 'object_files', 'object_issues', 'action_properties', 'locations', 'pricing', 'quantities', 'times', 'advanced', 'notifications', 'terms'], 'integer'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'presentation_id' => Yii::t('app', 'Presentation ID'),
            'industry_properties' => Yii::t('app', 'Industry Properties'),
            'object_container' => Yii::t('app', 'Object Container'),
            'object_models' => Yii::t('app', 'Object Models'),
            'object_properties' => Yii::t('app', 'Object Properties'),
            'object_files' => Yii::t('app', 'Object Files'),
            'object_issues' => Yii::t('app', 'Object Issues'),
            'action_properties' => Yii::t('app', 'Action Properties'),
            'locations' => Yii::t('app', 'Locations'),
            'pricing' => Yii::t('app', 'Pricing'),
            'quantities' => Yii::t('app', 'Quantities'),
            'times' => Yii::t('app', 'Times'),
            'advanced' => Yii::t('app', 'Advanced'),
            'notifications' => Yii::t('app', 'Notifications'),
            'terms' => Yii::t('app', 'Terms'),
        ];
    }
}
