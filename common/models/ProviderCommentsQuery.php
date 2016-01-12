<?php

namespace common\models;

/**
 * This is the ActiveQuery class for [[ProviderComments]].
 *
 * @see ProviderComments
 */
class ProviderCommentsQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        $this->andWhere('[[status]]=1');
        return $this;
    }*/

    /**
     * @inheritdoc
     * @return ProviderComments[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return ProviderComments|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}