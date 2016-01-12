<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "cs_methods".
 *
 * @property integer $id
 * @property integer $action_id
 * @property integer $attribute_id
 * @property string $type
 * @property integer $req
 *
 * @property CsActions $action
 * @property CsAttributes $attribute
 * @property OrderServiceMethods[] $orderServiceMethods
 * @property ProviderServiceMethods[] $providerServiceMethods
 */
class CsMethods extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'cs_methods';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['action_id', 'attribute_id', 'type'], 'required'],
            [['action_id', 'attribute_id', 'req'], 'integer'],
            [['type'], 'string']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'action_id' => 'Usluga.',
            'attribute_id' => 'Atribut.',
            'type' => 'Vrsta opcije usluge. 1 - input[number], 2 - radio, 3 - select, 4 - multiselect, 5 - checkbox(y/n), 6 - input[text]',
            'req' => 'Važnost opcije usluge. 0 - opciono; 1 - obavezno.',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAction()
    {
        return $this->hasOne(CsActions::className(), ['id' => 'action_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAttribute()
    {
        return $this->hasOne(CsAttributes::className(), ['id' => 'attribute_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getOrderServiceMethods()
    {
        return $this->hasMany(OrderServiceMethods::className(), ['method_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProviderServiceMethods()
    {
        return $this->hasMany(ProviderServiceMethods::className(), ['method_id' => 'id']);
    }

    /**
     * @inheritdoc
     * @return CsMethodsQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new CsMethodsQuery(get_called_class());
    }
}
