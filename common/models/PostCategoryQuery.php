<?php

namespace common\models;

/**
 * This is the ActiveQuery class for [[PostCategory]].
 *
 * @see PostCategory
 */
class PostCategoryQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        $this->andWhere('[[status]]=1');
        return $this;
    }*/

    /**
     * @inheritdoc
     * @return PostCategory[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return PostCategory|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}