<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "cs_products".
 *
 * @property string $id
 * @property string $object_id
 * @property string $object_property_id
 * @property string $property_name
 * @property string $name
 * @property string $product_id
 * @property string $level
 * @property string $class
 * @property string $base_product_id
 * @property string $predecessor_id
 * @property string $successor_id
 * @property string $description
 */
class CsProducts extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'cs_products';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['object_id', 'object_property_id', 'property_name', 'name', 'level'], 'required'],
            [['object_id', 'object_property_id', 'product_id', 'base_product_id', 'predecessor_id', 'successor_id'], 'integer'],
            [['class'], 'string'],
            [['property_name'], 'string', 'max' => 64],
            [['name'], 'string', 'max' => 256],
            [['level', 'description'], 'string', 'max' => 32],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'object_id' => Yii::t('app', 'Object ID'),
            'object_property_id' => Yii::t('app', 'Object Property ID'),
            'property_name' => Yii::t('app', 'Property Name'),
            'name' => Yii::t('app', 'Name'),
            'product_id' => Yii::t('app', 'Product ID'),
            'level' => Yii::t('app', 'Level'),
            'class' => Yii::t('app', 'Class'),
            'base_product_id' => Yii::t('app', 'Base Product ID'),
            'predecessor_id' => Yii::t('app', 'Predecessor ID'),
            'successor_id' => Yii::t('app', 'Successor ID'),
            'description' => Yii::t('app', 'Description'),
        ];
    }

    /**
     * @inheritdoc
     * @return CsProductsQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new CsProductsQuery(get_called_class());
    }
}
