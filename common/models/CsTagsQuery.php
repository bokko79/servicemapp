<?php

namespace common\models;

/**
 * This is the ActiveQuery class for [[CsTags]].
 *
 * @see CsTags
 */
class CsTagsQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        $this->andWhere('[[status]]=1');
        return $this;
    }*/

    /**
     * @inheritdoc
     * @return CsTags[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return CsTags|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}