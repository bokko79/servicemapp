<?php

namespace common\models;

/**
 * This is the ActiveQuery class for [[UserObjectImages]].
 *
 * @see UserObjectImages
 */
class UserObjectImagesQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        $this->andWhere('[[status]]=1');
        return $this;
    }*/

    /**
     * @inheritdoc
     * @return UserObjectImages[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return UserObjectImages|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}