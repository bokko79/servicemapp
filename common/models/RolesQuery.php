<?php

namespace common\models;

/**
 * This is the ActiveQuery class for [[Roles]].
 *
 * @see Roles
 */
class RolesQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        $this->andWhere('[[status]]=1');
        return $this;
    }*/

    /**
     * @inheritdoc
     * @return Roles[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return Roles|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}