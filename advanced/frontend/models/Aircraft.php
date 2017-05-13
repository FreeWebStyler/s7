<?php

#namespace app\models;
namespace frontend\models;

use Yii;

/**
 * This is the model class for table "aircraft".
 *
 * @property integer $id
 * @property integer $type
 * @property string $name
 * @property string $bortnumber
 * @property integer $econom
 * @property integer $business
 */
class Aircraft extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'aircraft';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['type', 'econom', 'business'], 'integer'],
            [['name'], 'string', 'max' => 10],
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
            'type' => 'Type',
            'name' => 'Name',
            'bortnumber' => 'Bortnumber',
            'econom' => 'Econom',
            'business' => 'Business',
        ];
    }

    public function getFlight()
    {
        return $this->hasMany(Product::className(), ['brand_id' => 'id']);
    }
}
