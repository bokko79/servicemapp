<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "order_service_object_issues".
 *
 * @property string $id
 * @property string $order_service_id
 * @property integer $object_issue_id
 * @property string $description
 *
 * @property OrderServices $orderService
 * @property CsObjectIssues $objectIssue
 */
class OrderServiceObjectIssues extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'order_service_object_issues';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['order_service_id', 'description'], 'required'],
            [['order_service_id', 'object_issue_id'], 'integer'],
            [['description'], 'string', 'max' => 128]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'order_service_id' => Yii::t('app', 'Order Service ID'),
            'object_issue_id' => Yii::t('app', 'Object Issue ID'),
            'description' => Yii::t('app', 'Description'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getOrderService()
    {
        return $this->hasOne(OrderServices::className(), ['id' => 'order_service_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getObjectIssue()
    {
        return $this->hasOne(CsObjectIssues::className(), ['id' => 'object_issue_id']);
    }
}
