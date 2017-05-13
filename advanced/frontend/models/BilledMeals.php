<?php

#namespace app\models;
namespace frontend\models;

use Yii;

/**
 * This is the model class for table "billed_meals".
 *
 * @property integer $id
 * @property integer $flight_id
 * @property integer $flight_load_id
 * @property string $flight_date
 * @property string $nomenclature
 * @property string $iata_code
 * @property string $type
 * @property integer $delivery_number
 * @property string $name
 * @property string $class
 * @property string $bortnumber
 * @property integer $qty
 * @property double $total
 * @property double $total_novat_discounted
 * @property string $airport
 * @property integer $invoice_number
 * @property string $name_code
 * @property double $price_per_one
 * @property integer $checked
 * @property string $check_date
 * @property string $validation_errors
 */
class BilledMeals extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'billed_meals';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['flight_id', 'flight_load_id', 'delivery_number', 'qty', 'invoice_number', 'checked'], 'integer'],
            [['flight_date', 'check_date'], 'safe'],
            [['total', 'total_novat_discounted', 'price_per_one'], 'number'],
            [['nomenclature'], 'string', 'max' => 30],
            [['iata_code'], 'string', 'max' => 10],
            [['type', 'class', 'name_code'], 'string', 'max' => 20],
            [['name'], 'string', 'max' => 150],
            [['bortnumber'], 'string', 'max' => 5],
            [['airport'], 'string', 'max' => 3],
            [['validation_errors'], 'string', 'max' => 100],
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
            'flight_load_id' => 'Flight Load ID',
            'flight_date' => 'Flight Date',
            'nomenclature' => 'Nomenclature',
            'iata_code' => 'Iata Code',
            'type' => 'Type',
            'delivery_number' => 'Delivery Number',
            'name' => 'Name',
            'class' => 'Class',
            'bortnumber' => 'Bortnumber',
            'qty' => 'Qty',
            'total' => 'Total',
            'total_novat_discounted' => 'Total Novat Discounted',
            'airport' => 'Airport',
            'invoice_number' => 'Invoice Number',
            'name_code' => 'Name Code',
            'price_per_one' => 'Price Per One',
            'checked' => 'Checked',
            'check_date' => 'Check Date',
            'validation_errors' => 'Validation Errors',
        ];
    }

    /**
     * @inheritdoc
     * @return BilledMealsQuery the active query used by this AR class.
     */
   /* public static function find()
    {
        return new BilledMealsQuery(get_called_class());
    }*/

    public function getFlightLoad()
    {
        return $this->hasMany(FlightLoad::className(), ['id' => 'flight_load_id']);
    }
}
