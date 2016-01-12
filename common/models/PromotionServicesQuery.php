<?php

namespace common\models;

/**
 * This is the ActiveQuery class for [[PromotionServices]].
 *
 * @see PromotionServices
 */
class PromotionServicesQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        $this->andWhere('[[status]]=1');
        return $this;
    }*/

    /**
     * @inheritdoc
     * @return PromotionServices[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return PromotionServices|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}