<?php

namespace common\models;

/**
 * This is the ActiveQuery class for [[CsAttributeModels]].
 *
 * @see CsAttributeModels
 */
class CsAttributeModelsQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        $this->andWhere('[[status]]=1');
        return $this;
    }*/

    /**
     * @inheritdoc
     * @return CsAttributeModels[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return CsAttributeModels|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}