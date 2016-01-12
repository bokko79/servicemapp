<?php

namespace common\models;

/**
 * This is the ActiveQuery class for [[FeedbackOnUser]].
 *
 * @see FeedbackOnUser
 */
class FeedbackOnUserQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        $this->andWhere('[[status]]=1');
        return $this;
    }*/

    /**
     * @inheritdoc
     * @return FeedbackOnUser[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return FeedbackOnUser|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}