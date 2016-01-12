<?php

namespace common\models;

/**
 * This is the ActiveQuery class for [[CsCategories]].
 *
 * @see CsCategories
 */
class CsCategoriesQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        $this->andWhere('[[status]]=1');
        return $this;
    }*/

    /**
     * @inheritdoc
     * @return CsCategories[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return CsCategories|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}