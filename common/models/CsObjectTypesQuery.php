<?php

namespace common\models;

/**
 * This is the ActiveQuery class for [[CsObjectTypes]].
 *
 * @see CsObjectTypes
 */
class CsObjectTypesQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        $this->andWhere('[[status]]=1');
        return $this;
    }*/

    /**
     * @inheritdoc
     * @return CsObjectTypes[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return CsObjectTypes|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}