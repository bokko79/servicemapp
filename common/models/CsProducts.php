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
     * @return \yii\db\ActiveQuery
     */
    public function getObject()
    {
        return $this->hasOne(CsObjects::className(), ['id' => 'object_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getObjectProperty()
    {
        return $this->hasOne(CsObjectProperties::className(), ['id' => 'object_property_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getParent()
    {
        return $this->hasOne(CsProducts::className(), ['id' => 'product_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBaseProduct()
    {
        return $this->hasOne(CsProducts::className(), ['id' => 'base_product_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPredecessor()
    {
        return $this->hasOne(CsProducts::className(), ['id' => 'predecessor_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSuccessor()
    {
        return $this->hasOne(CsProducts::className(), ['id' => 'successor_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProductProperties()
    {
        return $this->hasMany(CsProductProperties::className(), ['product_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProductIssues()
    {
        return $this->hasMany(CsProductIssues::className(), ['product_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPath($object)
    {
        $path = [];
        $level = $object->level;
        $parent = $object->parent;
        
        if ($level>1)
        {            
            $path[$level-1] = $parent;     
            $path = array_merge($this->getpath($parent), $path);
        }

        return $path;
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProperties($product)
    {
        $properties = [];
        $object = $product->object;
        if($productProperties = $product->productProperties){
            foreach($productProperties as $productProperty){
                if(!in_array($productProperty->objectProperty, $properties)){
                    $properties[] = $productProperty->objectProperty;
                }
            }
        }
            
        if($product->getPath($product)){
            foreach ($product->getPath($product) as $key => $productpp) {
                if($productPropertiespp = $productpp->productProperties){
                    foreach($productPropertiespp as $productPropertypp){
                        if($productPropertypp->objectProperty->property_class!='private' and !in_array($productPropertypp->objectProperty, $properties)){
                            $properties[] = $productPropertypp->objectProperty;
                        }
                    }
                }                    
            }
        }

        if($objectProperties = $object->objectProperties){
            foreach($objectProperties as $objectProperty){
                if(!in_array($objectProperty, $properties)){
                    $properties[] = $objectProperty;
                }
            }
        }
            
        if($object->getPath($object)){
            foreach ($this->getPath($this) as $key => $objectpp) {
                if($objectPropertiespp = $objectpp->objectProperties){
                    foreach($objectPropertiespp as $objectPropertypp){
                        if($objectPropertypp->property_class!='private' and !in_array($objectPropertypp, $properties)){
                            $properties[] = $objectPropertypp;
                        }
                    }
                }                    
            }
        }

        return $properties;
    }
}
