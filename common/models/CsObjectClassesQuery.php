<?php

namespace common\models;

/**
 * This is the ActiveQuery class for [[CsObjectClasses]].
 *
 * @see CsObjectClasses
 */
class CsObjectClassesQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        $this->andWhere('[[status]]=1');
        return $this;
    }*/

    /**
     * @inheritdoc
     * @return CsObjectClasses[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return CsObjectClasses|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}