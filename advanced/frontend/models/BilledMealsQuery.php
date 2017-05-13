<?php

namespace app\models;

/**
 * This is the ActiveQuery class for [[BilledMeals]].
 *
 * @see BilledMeals
 */
class BilledMealsQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * @inheritdoc
     * @return BilledMeals[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return BilledMeals|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
