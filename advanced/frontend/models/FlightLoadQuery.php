<?php

namespace app\models;
#namespace frontend\models;

/**
 * This is the ActiveQuery class for [[FlightLoad]].
 *
 * @see FlightLoad
 */
class FlightLoadQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * @inheritdoc
     * @return FlightLoad[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return FlightLoad|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }

    /*public function getBilledMeals()
    {
        return $this->hasMany(BilledMeals::className(), ['flight_load_id' => 'id']);
    }*/
}
