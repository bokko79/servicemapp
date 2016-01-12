<?php

namespace common\models;

/**
 * This is the ActiveQuery class for [[UserFilters]].
 *
 * @see UserFilters
 */
class UserFiltersQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        $this->andWhere('[[status]]=1');
        return $this;
    }*/

    /**
     * @inheritdoc
     * @return UserFilters[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return UserFilters|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}