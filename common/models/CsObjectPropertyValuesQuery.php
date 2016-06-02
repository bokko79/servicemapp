<?php

namespace common\models;

/**
 * This is the ActiveQuery class for [[CsObjectPropertyValues]].
 *
 * @see CsObjectPropertyValues
 */
class CsObjectPropertyValuesQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * @inheritdoc
     * @return CsObjectPropertyValues[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return CsObjectPropertyValues|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
