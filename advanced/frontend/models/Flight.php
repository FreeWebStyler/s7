<?php

#namespace app\models;
namespace frontend\models;

use Yii;

/**
 * This is the model class for table "flight".
 *
 * @property integer $id
 * @property string $from
 * @property string $to
 * @property string $duration
 */
class Flight extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'flight';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id'], 'required'],
            [['id'], 'integer'],
            [['duration'], 'safe'],
            [['from', 'to'], 'string', 'max' => 3],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'from' => 'From',
            'to' => 'To',
            'duration' => 'Duration',
        ];
    }

    /**
     * @inheritdoc
     * @return FlightQuery the active query used by this AR class.
     */
   /*public static function find()
    {
        return new FlightQuery(get_called_class());
    }*/

    public function getProducts()
    {
        return $this->hasMany(Product::className(), ['brand_id' => 'id']);
    }
}
