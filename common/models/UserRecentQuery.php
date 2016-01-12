<?php

namespace common\models;

/**
 * This is the ActiveQuery class for [[UserRecent]].
 *
 * @see UserRecent
 */
class UserRecentQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        $this->andWhere('[[status]]=1');
        return $this;
    }*/

    /**
     * @inheritdoc
     * @return UserRecent[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return UserRecent|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}