<?php

namespace common\models;

/**
 * This is the ActiveQuery class for [[ProviderPortfolioImages]].
 *
 * @see ProviderPortfolioImages
 */
class ProviderPortfolioImagesQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        $this->andWhere('[[status]]=1');
        return $this;
    }*/

    /**
     * @inheritdoc
     * @return ProviderPortfolioImages[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return ProviderPortfolioImages|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}