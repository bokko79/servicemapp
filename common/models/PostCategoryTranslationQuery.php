<?php

namespace common\models;

/**
 * This is the ActiveQuery class for [[PostCategoryTranslation]].
 *
 * @see PostCategoryTranslation
 */
class PostCategoryTranslationQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        $this->andWhere('[[status]]=1');
        return $this;
    }*/

    /**
     * @inheritdoc
     * @return PostCategoryTranslation[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return PostCategoryTranslation|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}