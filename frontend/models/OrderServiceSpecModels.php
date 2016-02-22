<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "order_service_spec_models".
 *
 * @property string $id
 * @property string $order_service_spec_id
 * @property integer $spec_model
 * @property string $description
 *
 * @property OrderServiceSpecs $orderServiceSpec
 * @property PropertyModel $propertyModel
 */
class OrderServiceSpecModels extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'order_service_spec_models';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['order_service_spec_id', 'spec_model'], 'required'],
            [['order_service_spec_id', 'spec_model'], 'integer'],
            [['description'], 'string'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'order_service_spec_id' => Yii::t('app', 'Order Service Spec ID'),
            'spec_model' => Yii::t('app', 'Spec Model'),
            'description' => Yii::t('app', 'Description'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getOrderServiceSpec()
    {
        return $this->hasOne(OrderServiceSpecs::className(), ['id' => 'order_service_spec_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getModel()
    {
        return $this->hasOne(CsPropertyModels::className(), ['id' => 'spec_model']);
    }
}
