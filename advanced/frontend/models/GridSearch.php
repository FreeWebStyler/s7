<?php

namespace frontend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use yii\db\Query;
use frontend\models\FlightLoad;

/**
 * AircraftSearch represents the model behind the search form about `frontend\models\Aircraft`.
 */
class GridSearch extends FlightLoad
{
    /*public $from;
    public $to;*/
    public $id;
    public $type;
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'flight_id'], 'integer'],
           // [['name', 'bortnumber'], 'safe'],
            //[['from', 'to'], 'string', 'max' => 3],
            //[['type'], 'string'],
            [['type'], 'safe'],
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
        $query = FlightLoad::find();
        //pred($query);
        //$query = new Query;
        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => [
                'forcePageParam' => false,
                //'forcePageParam' => true,
                'pageSizeParam' => false,
                //'pageSizeParam' => true,
                'pageSize' => 10
            ]
        ]);

        //$query->joinWith(['flight']);
        //$query->joinWith(['billedMeals']);
        $query->innerJoinWith(['billedMeals']);
        //$query->select(['flight_load.id','flight_load.flight_id','billed_meals.type']);
        //$query->select(['flight_load.*', 'billed_meals.type']);


        //$query->groupBy(['flight_load.id']);

        //$query->joinWith(['billedMeals']);
        //$query->with(['billedMeals']);
        //$query->join(['billedMeals']);

        $dataProvider->setSort([
            'attributes' => [
            'id' => [
                'asc' => ['flight_load.id' => SORT_ASC],
                'desc' => ['flight_load.id' => SORT_DESC],
                'label' => 'ID'
            ],
            'flight_id' => [
                'asc' => ['flight_id' => SORT_ASC],
                'desc' => ['flight_id' => SORT_DESC],
                'label' => 'ID рейса'
            ],
                /*'from' => [
                    'asc' => ['flight.from' => SORT_ASC],
                    'desc' => ['flight.from' => SORT_DESC],
                    'label' => 'Из'
                ],*/
                'type' => [
                    'asc' => ['billed_meals.type' => SORT_ASC],
                    'desc' => ['billed_meals.type' => SORT_DESC],
                    'label' => 'Тип',
                    //'id'    => 'pup',
                ],
            ]
        ]);

        $this->load($params);

        //print_r($this->type);die;
        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        //$query->andFilterWhere(['like', 'billed_meals.type', "Блюдо"]);
        //$query->andFilterWhere(['like', 'billed_meals.type', 'Блюдо']);

        //$query->andFilterWhere(['like', 'billed_meals.type', 'Блюдо']);

        //$query->andFilterWhere(['like', 'billed_meals.type', 'Товар']);

        //$query->andFilterWhere(['flight_load_id' => $this->id]);

        //$query->andFilterWhere(['like', 'billed_meals.bortnumber', "VPBNG"]);

        //$query->where(['billed_meals.type' => 'Блюдо']);
        //$query->where(['like','billed_meals.type','Блюдо']);

        //$query->andFilterWhere(['like','billed_meals.type', $this->type]);

        //$this->addCondition($query, 'billed_meals.type');
        //$query->andWhere("billed_meals.type LIKE 'Блюдо'");

        //pred($dataProvider);

        //pred($this->id);
        //pred(gettype($this->id));
        // grid filtering conditions

        $query->andFilterWhere([

        //$query->andWhere([
            'flight_load.id'            => $this->id,
           /// 'billed_meals.flight_id'    => $this->flight_id,
            //'from'      => $this->from
            //'billed_meals.type'         => $this->type
        ]);

        //echo '<pre>';        print_r($query);die;

        /*$query->andFilterWhere([
            'like','billed_meals.type','Блюдо'
        ]);*/

        //$query->where(['billed_meals.type' => 'Блюдо']);
        //$query->where(['like','billed_meals.type','Блюдо']);

        /*$query->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'bortnumber', $this->bortnumber]);*/
        //pred($dataProvider);
        return $dataProvider;
    }
}