<?php

namespace common\models;

/**
 * This is the ActiveQuery class for [[ProviderServiceTermExpenses]].
 *
 * @see ProviderServiceTermExpenses
 */
class ProviderServiceTermExpensesQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        $this->andWhere('[[status]]=1');
        return $this;
    }*/

    /**
     * @inheritdoc
     * @return ProviderServiceTermExpenses[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return ProviderServiceTermExpenses|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}