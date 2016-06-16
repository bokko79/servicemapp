<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "order_industry_properties".
 *
 * @property string $id
 * @property string $order_id
 * @property integer $industry_property_id
 * @property string $description
 */
class OrderIndustryProperties extends \yii\db\ActiveRecord
{
    public $service;
    public $serviceSkill;
    public $property;
    public $skill;
    public $skill_models = [];

    private $_skill;
    private $_property;

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'order_industry_properties';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        $industrySkill = $this->getIndustrySkill();
        $property = $this->getProperty();
        $skill_validation_requirement = ($industrySkill->required) ? ['skill', 'required', 'message'=>Yii::t('app', 'Unesite {skill_name}', ['skill_name'=>$property->tNameAkk])] : ['skill', 'safe'];
        switch ($property->type) {
            case 1:
                $skill_validation_type = ['skill', 'integer', 'message'=>Yii::t('app', 'Vrednost "{skill_name}" mora biti broj', ['skill_name'=>$property->tName])];
                break;

            case 6:
                $skill_validation_type = ['skill', 'string'];
                break;
            
            default:
                $skill_validation_type = ['skill', 'safe'];
                break;
        }

        return [
            $skill_validation_requirement,
            $skill_validation_type,
            [['order_id', 'skill_id'], 'required'],
            [['order_id', 'skill_id'], 'integer'],
            [['value', 'value_max'], 'string', 'max' => 100],
            [['multiple_values', 'read_only'], 'integer'],
            [['value_operator'], 'string'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'order_id' => Yii::t('app', 'Order ID'),
            'skill_id' => Yii::t('app', 'Skill ID'),
            'description' => Yii::t('app', 'Description'),
        ];
    }

    /**
     * Service to be added to cart
     *
     * @return CsServiceMethods|null
     */
    public function getIndustrySkill()
    {
        if ($this->_skill === null) {
            $this->_skill = $this->serviceSkill;
        }
        return $this->_skill;
    }

    /**
     * Property of the object.
     *
     * @return CsProperties|null
     */
    public function getProperty()
    {
        if ($this->_property === null) {
            $this->_property = $this->property;
        }
        return $this->_property;
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getOrder()
    {
        return $this->hasOne(Orders::className(), ['id' => 'order_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIndustryProperty()
    {
        return $this->hasOne(CsIndustryProperties::className(), ['id' => 'industry_property_id']);
    }
}
