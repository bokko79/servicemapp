<?php

namespace common\models;

/**
 * This is the ActiveQuery class for [[UserObjectSpecs]].
 *
 * @see UserObjectSpecs
 */
class UserObjectSpecsQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        $this->andWhere('[[status]]=1');
        return $this;
    }*/

    /**
     * @inheritdoc
     * @return UserObjectSpecs[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return UserObjectSpecs|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}