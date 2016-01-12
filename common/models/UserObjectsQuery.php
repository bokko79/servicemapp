<?php

namespace common\models;

/**
 * This is the ActiveQuery class for [[UserObjects]].
 *
 * @see UserObjects
 */
class UserObjectsQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        $this->andWhere('[[status]]=1');
        return $this;
    }*/

    /**
     * @inheritdoc
     * @return UserObjects[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return UserObjects|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}