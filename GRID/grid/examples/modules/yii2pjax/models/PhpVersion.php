<?php

namespace app\modules\yii2pjax\models;

use Yii;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "php_version".
 *
 * @property integer $id
 * @property string $branch
 * @property string $version
 * @property string $release_date
 */
class PhpVersion extends ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'php_version';
    }

    public static function getDB()
    {
        return \Yii::$app->getModule('yii2pjax')->db;
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['branch', 'version', 'release_date'], 'string'],
            [['release_date'], 'date'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'branch' => 'Ветка',
            'version' => 'Версия',
            'release_date' => 'Дата выпуска',
        ];
    }
}
