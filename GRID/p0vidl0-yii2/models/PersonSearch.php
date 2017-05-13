<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Person;
use yii\db\QueryInterface;

/**
 * PersonSearch represents the model behind the search form about `app\models\Person`.
 */
class PersonSearch extends Person
{
    /* Вычисляемые аттрибуты */
    public $fullName;
    public $countryName;
    public $parentName;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'country_id', 'parent_id'], 'integer'],
            [['first_name', 'last_name', 'fullName', 'countryName', 'parentName'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $query = Person::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        /* Включаем связанные таблицы в выборку */
        $query->joinWith(['country', 'parent']);

        /**
         * Настройка параметров сортировки
         * Важно: должна быть выполнена раньше $this->load($params)
         */
        $dataProvider->setSort([
            'attributes' => [
                'id',
                'fullName' => [
                    'asc' => ['CONCAT(person.first_name, "", person.last_name)' => SORT_ASC],
                    'desc' => ['CONCAT(person.first_name, "", person.last_name)' => SORT_DESC],
                    'label' => 'Полное имя',
                    'default' => SORT_ASC
                ],
                'countryName' => [
                    'asc' => ['country.country_name' => SORT_ASC],
                    'desc' => ['country.country_name' => SORT_DESC],
                    'label' => 'Название страны'
                ],
                'parentName' => [
                    'asc' => [
                        'parent.first_name' => SORT_ASC,
                        'parent.last_name' => SORT_ASC
                    ],
                    'desc' => [
                        'parent.first_name' => SORT_DESC,
                        'parent.last_name' => SORT_DESC
                    ],
                    'label' => 'Родитель',
                    'default' => SORT_ASC
                ],
                'country_id',
            ]
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'country_id' => $this->country_id,
            'parent_id' => $this->parent_id,
        ]);

        $query->andFilterWhere(['like', 'first_name', $this->first_name])
            ->andFilterWhere(['like', 'last_name', $this->last_name])
            /* Фильтр по полному имени */
            ->andFilterWhere(['like', 'CONCAT(first_name, " ", last_name)', $this->fullName]);


        // Фильтр по стране
        if ($this->countryName) {
            $query->andFilterWhere(['like', 'country.country_name', $this->countryName]);
        }

        // Фильтр по родительской записи
        if ($this->parentName) {
            $query->andWhere([
                'like',
                'CONCAT(parent.first_name, " ", parent.last_name)',
                $this->fullName]
            );
        }

        return $dataProvider;
    }

    protected function addCondition(QueryInterface $query, $attribute, $partialMatch = false)
    {
        if (($pos = strrpos($attribute, '.')) !== false) {
            $modelAttribute = substr($attribute, $pos + 1);
        } else {
            $modelAttribute = $attribute;
        }

        $value = $this->$modelAttribute;
        if (trim($value) === '') {
            return;
        }

        /*
         * Для корректной работы фильтра со связью со
         * свой же моделью делаем:
         */
        $attribute = "person.$attribute";

        if ($partialMatch) {
            $query->andWhere(['like', $attribute, $value]);
        } else {
            $query->andWhere([$attribute => $value]);
        }
    }
}
