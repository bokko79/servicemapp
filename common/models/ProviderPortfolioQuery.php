<?php

namespace common\models;

/**
 * This is the ActiveQuery class for [[ProviderPortfolio]].
 *
 * @see ProviderPortfolio
 */
class ProviderPortfolioQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        $this->andWhere('[[status]]=1');
        return $this;
    }*/

    /**
     * @inheritdoc
     * @return ProviderPortfolio[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return ProviderPortfolio|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}