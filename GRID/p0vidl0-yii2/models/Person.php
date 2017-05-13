<?php

namespace app\models;

use Yii;
use yii\db\ActiveQuery;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "person".
 *
 * @property integer $id
 * @property string $first_name
 * @property string $last_name
 * @property integer $country_id
 * @property integer $parent_id
 *
 * @property Country $country
 * @property string $fullName
 * @property string $countryName
 * @property string $parentName
 */
class Person extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'person';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['country_id', 'parent_id'], 'integer'],
//            [['country_id'], 'required'],
            [['first_name', 'last_name'], 'string', 'max' => 255],
            [['country_id'], 'exist', 'skipOnError' => true, 'targetClass' => Country::className(), 'targetAttribute' => ['country_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'first_name' => 'Имя',
            'last_name' => 'Фамилия',
            'fullName' => 'Полное имя',
            'country_id' => 'Страна проживания',
            'countryName' => 'Страна проживания',
            'parent_id' => 'Родитель',
            'parentName' => 'Родитель',
        ];
    }

    /**
     * Геттер для полного имени человека
     * @return string
     */
    public function getFullName() {
        return $this->first_name . ' ' . $this->last_name;
    }
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCountry()
    {
        return $this->hasOne(Country::className(), ['id' => 'country_id']);
    }

    /**
     * Геттер для названия страны
     * @return string
     */
    public function getCountryName() {
        return $this->country->country_name;
    }

    /**
     * Родитель
     * @return ActiveQuery
     */
    public function getParent() {
        return $this->hasOne(
            self::className(),
            ['parent_id' => 'id'])->from(self::tableName() . ' AS parent'
        );
    }

    /**
     * Геттер для полного имени родителя
     * @return mixed
     */
    public function getParentName() {
        return $this->parent->fullName;
    }

    /**
     * @inheritdoc
     * @return PersonQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new PersonQuery(get_called_class());
    }

    public function getList()
    {
        return ArrayHelper::map(
            static::find()
                ->select(['id', 'CONCAT(first_name, " ", last_name) AS name'])
                ->andWhere(['!=', 'id', $this->id])
                ->asArray()
                ->all(),
            'id',
            'name');
    }
}
