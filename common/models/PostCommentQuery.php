<?php

namespace common\models;

/**
 * This is the ActiveQuery class for [[PostComment]].
 *
 * @see PostComment
 */
class PostCommentQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        $this->andWhere('[[status]]=1');
        return $this;
    }*/

    /**
     * @inheritdoc
     * @return PostComment[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return PostComment|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}