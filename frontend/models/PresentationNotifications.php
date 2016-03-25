<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "presentation_notifications".
 *
 * @property string $presentation_id
 * @property string $notification_type
 * @property integer $coverage
 * @property integer $specs
 * @property integer $methods
 * @property integer $qty
 * @property integer $consumer
 * @property integer $price
 * @property integer $issues
 * @property integer $availability
 * @property integer $validity
 * @property string $time
 * @property string $description
 */
class PresentationNotifications extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'presentation_notifications';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['presentation_id', 'time'], 'required'],
            [['presentation_id', 'coverage', 'specs', 'methods', 'qty', 'consumer', 'price', 'issues', 'availability', 'validity'], 'integer'],
            [['notification_type', 'description'], 'string'],
            [['time'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'presentation_id' => Yii::t('app', 'Presentation ID'),
            'notification_type' => Yii::t('app', 'Notification Type'),
            'coverage' => Yii::t('app', 'Coverage'),
            'specs' => Yii::t('app', 'Specs'),
            'methods' => Yii::t('app', 'Methods'),
            'qty' => Yii::t('app', 'Qty'),
            'consumer' => Yii::t('app', 'Consumer'),
            'price' => Yii::t('app', 'Price'),
            'issues' => Yii::t('app', 'Issues'),
            'availability' => Yii::t('app', 'Availability'),
            'validity' => Yii::t('app', 'Validity'),
            'time' => Yii::t('app', 'Time'),
            'description' => Yii::t('app', 'Description'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPresentation()
    {
        return $this->hasOne(Presentations::className(), ['id' => 'presentation_id']);
    }
}
