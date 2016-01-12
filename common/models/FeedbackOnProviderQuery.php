<?php

namespace common\models;

/**
 * This is the ActiveQuery class for [[FeedbackOnProvider]].
 *
 * @see FeedbackOnProvider
 */
class FeedbackOnProviderQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        $this->andWhere('[[status]]=1');
        return $this;
    }*/

    /**
     * @inheritdoc
     * @return FeedbackOnProvider[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return FeedbackOnProvider|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}