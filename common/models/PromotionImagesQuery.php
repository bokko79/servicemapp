<?php

namespace common\models;

/**
 * This is the ActiveQuery class for [[PromotionImages]].
 *
 * @see PromotionImages
 */
class PromotionImagesQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        $this->andWhere('[[status]]=1');
        return $this;
    }*/

    /**
     * @inheritdoc
     * @return PromotionImages[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return PromotionImages|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}