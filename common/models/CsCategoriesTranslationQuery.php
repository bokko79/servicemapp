<?php

namespace common\models;

/**
 * This is the ActiveQuery class for [[CsCategoriesTranslation]].
 *
 * @see CsCategoriesTranslation
 */
class CsCategoriesTranslationQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        $this->andWhere('[[status]]=1');
        return $this;
    }*/

    /**
     * @inheritdoc
     * @return CsCategoriesTranslation[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return CsCategoriesTranslation|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}