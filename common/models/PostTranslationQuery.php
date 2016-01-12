<?php

namespace common\models;

/**
 * This is the ActiveQuery class for [[PostTranslation]].
 *
 * @see PostTranslation
 */
class PostTranslationQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        $this->andWhere('[[status]]=1');
        return $this;
    }*/

    /**
     * @inheritdoc
     * @return PostTranslation[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return PostTranslation|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}