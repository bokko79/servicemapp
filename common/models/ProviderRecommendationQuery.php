<?php

namespace common\models;

/**
 * This is the ActiveQuery class for [[ProviderRecommendation]].
 *
 * @see ProviderRecommendation
 */
class ProviderRecommendationQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        $this->andWhere('[[status]]=1');
        return $this;
    }*/

    /**
     * @inheritdoc
     * @return ProviderRecommendation[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return ProviderRecommendation|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}