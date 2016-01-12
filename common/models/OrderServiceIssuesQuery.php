<?php

namespace common\models;

/**
 * This is the ActiveQuery class for [[OrderServiceIssues]].
 *
 * @see OrderServiceIssues
 */
class OrderServiceIssuesQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        $this->andWhere('[[status]]=1');
        return $this;
    }*/

    /**
     * @inheritdoc
     * @return OrderServiceIssues[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return OrderServiceIssues|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}