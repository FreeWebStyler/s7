<?php

namespace frontend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use yii\data\ArrayDataProvider;
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
    public $flight_id;
    public $type;
    public $date;
    public $econom_load;
    public $econom_meal;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'flight_id', 'econom_load', 'econom_meal'], 'integer'],
           // [['name', 'bortnumber'], 'safe'],
            //[['from', 'to'], 'string', 'max' => 3],
            //[['type'], 'string'],
            [['type', 'date'], 'safe'],
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
        $this->load($params);
        //$query = FlightLoad::find();
        $query = new Query;
        //pred($query);
        /*$dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => [
                'forcePageParam' => false,
                //'forcePageParam' => true,
                'pageSizeParam' => false,
                //'pageSizeParam' => true,
                'pageSize' => 10
            ]
        ]);*/
        /*$dataProvider = new ArrayDataProvider([
            'allModels' => FlightLoad::find()->all(),
        ]);*/

        //pred($params);
        $perpage = isset($params['per-page']) ? $params['per-page'] : 10;
        $page = isset($params['page']) ? $params['page'] : 1;
        $offset = $page == 1 ? 0 : ($page - 1) * $perpage;

        //pre($offset, $perpage, $page);        debug($offset.' '.$perpage.' '.$page);
        #$limit = isset($params['per-page']) ? $params['per-page'] : 10;
        //pred($offset);        pred($limit);
        $query->select(['flight_load.id','flight_load.flight_id']);
        $query->from('flight_load as fl');
        //$query->offset('5');
        // $query->offset('11');
        $query->offset($offset);
        //$query->limit('10');
        $query->limit($perpage);
        //$query->all();

        //$c = $query->count('flight_load.id');

        $query->select([
            //'flight_load.id',
            'fl.flight_id',
            'fl.econom as econom_load',
            'fl.flight_date',
            'billed_meals.type',
            "(select sum(qty) from billed_meals where type='Комплект' and class='Эконом' and flight_id = fl.flight_id and flight_date=fl.flight_date) as econom_meal",

            ]);
        //pred($c);

        //$query->from('flight_load, billed_meals');
        $query->join('INNER JOIN', 'billed_meals', 'fl.id = billed_meals.flight_load_id');
        //$query->joinWith(['billedMeals']);
        //$query->with(['billedMeals']);

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

        //pred($this->date);
        //pred($params);

        $query->andFilterWhere([
        //$query->andWhere([
            //'fl.id'    => $this->id,
            'fl.flight_id'    => $this->flight_id,
           // 'billed_meals.flight_id'    => $this->flight_id,
            //'from'      => $this->from

            'billed_meals.type' => $this->type,

           // 'billed_meals.date' => $this->date
            //'billed_meals.type'         => 'Блюдо'
        ]);

        if($this->date){
            $start_date = $this->date.' 00:00:00';
            $end_date = $this->date.' 23:59:59';
            $query->andFilterWhere(['between', 'fl.flight_date', $start_date, $end_date]);
        }


        $c = $query->count('fl.id');

        //echo '<pre>';        print_r($query);die;

        /*$query->andFilterWhere([
            'like','billed_meals.type','Блюдо'
        ]);*/

        //$query->where(['billed_meals.type' => 'Блюдо']);
        //$query->where(['like','billed_meals.type','Блюдо']);

        /*$query->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'bortnumber', $this->bortnumber]);*/
        //pred($dataProvider);

        //pred($params);
        $sort = SORT_ASC;
        if(isset($params['sort'])){
            //$params['sort'] == '-id' ? $sort = SORT_DESC : $sort = SORT_ASC;
            $params['sort'] == '-flight_id' ? $sort = SORT_DESC : $sort = SORT_ASC;
        }

        $query->orderBy([
            //'fl.id'    => $sort,
            'fl.flight_id'    => $sort,
            'billed_meals.type' => $sort,
            //'name' => SORT_DESC,
        ]);
        //$query->groupBy(['billed_meals.type']);

        //pred($query->all());

        //pred($query->createCommand()->getRawSql());
        //pred($query->all());

        //pred($page);

        $dataProvider = new ArrayDataProvider([
            'allModels' => $query->all(),
            'totalCount' => $c,
            'sort' => [
                //'attributes' => ['fl.id']
                'attributes' => ['fl.flight_id']
            ],
            //'pagination' => false,

            'pagination' => [
                'forcePageParam' => false,
                //'forcePageParam' => true,
                'pageSizeParam' => false,
                //'pageSizeParam' => true,
                'pageSize' => 0,
                'pageSize' => 10,
                //'pageSize' => $perpage,
                'totalCount' => $c,
                'params' => $params,
                //'page' => $page,
                //'offset' => 5
                //'pageSizeLimit' => [5, 10],
            ]
        ]);

        //$query->joinWith(['flight']);
        //$query->joinWith(['billedMeals']);
        //$query->innerJoinWith(['billedMeals']);

        //$query->select(['flight_load.*', 'billed_meals.type']);

        //$query->groupBy(['flight_load.id']);

        //$query->joinWith(['billedMeals']);
        //$query->with(['billedMeals']);
        //$query->join(['billedMeals']);

        $dataProvider->setSort([
            'attributes' => [
            /*'id' => [
                'asc' => ['flight_load.id' => SORT_ASC],
                'desc' => ['flight_load.id' => SORT_DESC],
                'label' => 'ID'
            ],*/
            'id' => [
                'asc' => ['id' => SORT_ASC],
                'desc' => ['id' => SORT_DESC],
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
                    'asc' => ['type' => SORT_ASC],
                    'desc' => ['type' => SORT_DESC],
                    'label' => 'Тип',
                    //'id'    => 'pup',
                ],
                'flight_date' => [
                    'asc' => ['type' => SORT_ASC],
                    'desc' => ['type' => SORT_DESC],
                    'label' => 'Тип',
                    //'id'    => 'pup',
                ],
            ]
        ]);



        //print_r($this->type);die;
        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        return $dataProvider;
    }
}