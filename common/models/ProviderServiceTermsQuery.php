<?php

namespace common\models;

/**
 * This is the ActiveQuery class for [[ProviderServiceTerms]].
 *
 * @see ProviderServiceTerms
 */
class ProviderServiceTermsQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        $this->andWhere('[[status]]=1');
        return $this;
    }*/

    /**
     * @inheritdoc
     * @return ProviderServiceTerms[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return ProviderServiceTerms|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}