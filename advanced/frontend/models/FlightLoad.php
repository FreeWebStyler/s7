<?php

#namespace app\models;
namespace frontend\models;

use Yii;

use frontend\models\Flight;

/**
 * This is the model class for table "flight_load".
 *
 * @property integer $id
 * @property integer $flight_id
 * @property string $flight_date
 * @property string $bortnumber
 * @property integer $aircraft
 * @property integer $econom
 * @property integer $business
 * @property integer $crew
 * @property integer $pilots
 * @property integer $sluts
 */
class FlightLoad extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'flight_load';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['flight_id', 'aircraft', 'econom', 'business', 'crew', 'pilots', 'sluts'], 'integer'],
            [['flight_date'], 'safe'],
            [['bortnumber'], 'string', 'max' => 5],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'flight_id' => 'Flight ID',
            'flight_date' => 'Flight Date',
            'bortnumber' => 'Bortnumber',
            'aircraft' => 'Aircraft',
            'econom' => 'Econom',
            'business' => 'Business',
            'crew' => 'Crew',
            'pilots' => 'Pilots',
            'sluts' => 'Sluts',
            'from' => 'From',
        ];
    }

    /**
     * @inheritdoc
     * @return FlightLoadQuery the active query used by this AR class.
     */
    /*public static function find()
    {
        return new FlightLoadQuery(get_called_class());
    }*/

    public function getBilledMeals()
    {
        return $this->hasMany(BilledMeals::className(), ['flight_load_id' => 'id']);
    }

    public function getFlight()
    {
        return $this->hasMany(Flight::className(), ['id' => 'flight_id']);
    }

    public function getFrom()
    {
        if(isset($this->flight[0])) return $this->flight[0]->from;
        //print_r($this->flight);        die;
        //if(isset($this->flight['from'])) return $this->flight['from']->from;
        //die;
        //return $this->flight->from;
        //return $this->flight['from'];
    }

    public function getType()
    {
        //print_r($this->flight);die;
        //print_r($this);die;
        //print_r($this->billedMeals);die;
        if(isset($this->billedMeals[0])) return $this->billedMeals[0]->type;
    }
}
