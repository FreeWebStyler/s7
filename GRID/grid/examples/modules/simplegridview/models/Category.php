<?php

namespace app\modules\simplegridview\models;

use Yii;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;
use yii\helpers\ArrayHelper;
use yii\helpers\Url;

/**
 * This is the model class for table "category".
 *
 * @property integer $id
 * @property integer $parent_id
 * @property string $name
 * @property string $url
 * @property string $category_image
 * @property integer $created_at
 * @property integer $updated_at
 */
class Category extends ActiveRecord
{
    const DEFAULT_URL = 'http://nix-tips.ru';
    public $tmpImage;
    public $categoryImagePath;
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'category';
    }

    public static function getDB()
    {
        return \Yii::$app->getModule('simplegridview')->db;
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name'], 'required'],
            [['parent_id'], 'integer'],
            [['name', 'url'], 'string', 'max' => 45],
            [
                ['category_image'],
                'file',
                'skipOnEmpty' => true,
                'extensions' => 'png, jpg'
            ],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'parent_id' => 'Родительская категория',
            'name' => 'Название',
            'url' => 'Ссылка',
            'category_image' => 'Картинка',
            'categoryImagePath' => 'Картинка',
            '$tmpImage' => 'Картинка',
            'created_at' => 'Создано',
            'updated_at' => 'Изменено',
        ];
    }

    /**
     * @inheritdoc
     * @return CategoryQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new CategoryQuery(get_called_class());
    }

    public function behaviors()
    {
        return [
            TimestampBehavior::className(),
        ];
    }

    public static function getCategoriesList()
    {
        $categories = Category::find()->select(['id', 'name'])->all();
        return ArrayHelper::map($categories, 'id', 'name');;
    }

    public function getParent()
    {
        return $this->hasOne(Category::className(), ['id' => 'parent_id']);
    }

    public function getParentName()
    {
        $parent = $this->parent;

        return $parent ? $parent->name : '';
    }

    public static function getParentsList()
    {
        // Выбираем только те категории, у которых есть дочерние категории
        $parents = Category::find()
            ->select(['c.id', 'c.name'])
            ->join('JOIN', 'category c', 'category.parent_id = c.id')
            ->distinct(true)
            ->all();

        return ArrayHelper::map($parents, 'id', 'name');
    }

    public function getImagePath()
    {
        return Url::to(Yii::$app->params['uploadPath'] . $this->category_image, true);
    }

    public function beforeSave($insert)
    {
        if (parent::beforeSave($insert)) {
            if ($this->url == '')
            {
                $this->url = Category::DEFAULT_URL;
            }
            return true;
        } else {
            return false;
        }
    }

    public function afterFind()
    {
        if (mb_strlen($this->category_image) > 0) {
            $this->categoryImagePath = Url::toRoute($this->category_image);
        }
    }
}
