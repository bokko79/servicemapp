<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "cs_product_issues".
 *
 * @property string $id
 * @property string $product_id
 * @property string $issue
 * @property integer $type
 * @property string $description
 */
class CsProductIssues extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'cs_product_issues';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['product_id', 'issue'], 'required'],
            [['product_id', 'type'], 'integer'],
            [['description'], 'string'],
            [['issue'], 'string', 'max' => 64],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'product_id' => Yii::t('app', 'Product ID'),
            'issue' => Yii::t('app', 'Issue'),
            'type' => Yii::t('app', 'Type'),
            'description' => Yii::t('app', 'Description'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProduct()
    {
        return $this->hasOne(CsProducts::className(), ['id' => 'product_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getT()
    {
        return $this->hasMany(CsProductIssuesTranslation::className(), ['product_issue_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTranslation()
    {
        $object_translation = CsProductIssuesTranslation::find()->where('lang_code="SR" and product_issue_id='.$this->id)->one();
        if($object_translation) {
            return $object_translation;
        }
        return false;        
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTName()
    {
        if($this->getTranslation()) {
            return $this->getTranslation()->name;
        }       
        return false;   
    }
}
