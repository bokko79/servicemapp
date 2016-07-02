<?php

namespace common\models;

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
            //[['presentation_id', 'time'], 'required'],
            [['presentation_id', 'coverage', 'specs', 'methods', 'qty', 'consumer', 'price', 'issues', 'availability', 'validity'], 'integer'],
            [['notification_type'], 'string'],
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
            'notification_type' => Yii::t('app', 'Vrsta notifikacija'),
            'coverage' => Yii::t('app', 'Pokrivenost'),
            'specs' => Yii::t('app', 'Karakteristike predmeta'),
            'methods' => Yii::t('app', 'Načini vršenja usluge'),
            'qty' => Yii::t('app', 'Količina'),
            'consumer' => Yii::t('app', 'Broj korisnika'),
            'price' => Yii::t('app', 'Cena'),
            'issues' => Yii::t('app', 'Problemi'),
            'availability' => Yii::t('app', 'Dostupnost'),
            'validity' => Yii::t('app', 'Važenje'),
            'time' => Yii::t('app', 'Vreme'),
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
