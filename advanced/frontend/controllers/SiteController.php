<?php

namespace frontend\controllers;

use Yii;
use yii\base\InvalidParamException;
use yii\web\BadRequestHttpException;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use common\models\LoginForm;
use frontend\models\PasswordResetRequestForm;
use frontend\models\ResetPasswordForm;
use frontend\models\SignupForm;
use frontend\models\ContactForm;

#===============================================

use frontend\models\Aircraft as Aircraft;
use frontend\models\FlightLoad as FlightLoad;
#use frontend\models\Aircraft as AircraftSearchController;
use frontend\models\AircraftSearch;
use frontend\models\GridSearch;
use yii\data\ActiveDataProvider;
use yii\db\Query;

/**
 * Site controller
 */
class SiteController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['logout', 'signup'],
                'rules' => [
                    [
                        'actions' => ['signup'],
                        'allow' => true,
                        'roles' => ['?'],
                    ],
                    [
                        'actions' => ['logout'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    /**
     * @inheritdoc
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    /**
     * Displays homepage.
     *
     * @return mixed
     */
    public function actionIndex()
    {

        /*$searchModel = new CategorySearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);*/

        $searchModel = new AircraftSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        //$query = Aircraft::find()->where(['econom' => 144]);

        /*$dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => [
                'pageSize' => 10,
            ],
            'sort' => [
                'defaultOrder' => [
                    //'created_at' => SORT_DESC,
                    //'title' => SORT_ASC,
                    'id' => SORT_ASC,
                ]
            ],
        ]);*/

        //print_r($provider); die;

        //return $this->render('index');
        //$searchModel = new CategorySearch();
        //$dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays homepage.
     *
     * @return mixed
     */
    public function actionSearch()
    {
        /*$searchModel = new CategorySearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);*/

        $searchModel = new AircraftSearch();
        //$dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        //$query = Aircraft::find()->where(['econom' => 144]);

        /*$dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => [
                'pageSize' => 10,
            ],
            'sort' => [
                'defaultOrder' => [
                    //'created_at' => SORT_DESC,
                    //'title' => SORT_ASC,
                    'id' => SORT_ASC,
                ]
            ],
        ]);*/

        return $this->render('search', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionGrid()
    {
        /*$searchModel = new CategorySearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);*/

        //$query = Aircraft::find()->where(['econom' => 144]);
        //$query = Aircraft::find();
        /*$query = 'SELECT * FROM `flight`';
        $query = new Query;
        // compose the query
        $query->select('id')
            ->from('flight')
            ->limit(10);

        echo $query->createCommand()->sql;*/
        //Same as above $query->createCommand()->getRawSql();


        /*$fl = FlightLoad::findOne(1);
        $bms = $fl->billedMeals;*/

       /*$fl = FlightLoad::findOne(1);
        $fl = FlightLoad::find()->where(['id' => 1])->one();
        $fl = FlightLoad::find()->where(['id' => 1])->all();
        $fl = $fl[0];
        $bms = $fl->getBilledMeals();
        print_r($bms);die;*/

       //$modelFlightLoad = FlightLoad::find()->all();
       //$modelFlightLoad = FlightLoad::find();
        //$modelFlightLoad = FlightLoad::find(1)->one();
       // $modelFlightLoad = FlightLoad::find()->where(['econom' => 140]);
       // $modelFlightLoad = FlightLoad::find()->where(['id' => 1]);

        //$query = $modelFlightLoad->getBilledMeals();
/*
select fl.flight_id, fl.flight_date, econom as econom_load, (select sum(qty) from billed_meals where type='Комплект' and class='Эконом' and flight_id = fl.flight_id and flight_date=fl.flight_date) as econom_meal, fl.business as business_load, (select sum(qty) from billed_meals where type='Комплект' and class='Бизнес' and flight_id = fl.flight_id and flight_date=fl.flight_date) as business_meal, fl.crew as crew_load, (select sum(qty) from billed_meals where type='Комплект' and class='Экипаж ВС' and flight_id = fl.flight_id and flight_date=fl.flight_date) as crew_meal   from flight_load fl, billed_meals m where m.flight_load_id=fl.id GROUP BY `fl`.`id` ORDER BY `fl`.`flight_id` ASC LIMIT 10
*/
/*
select

fl.flight_id,
fl.flight_date,
econom as econom_load,
(select sum(qty) from billed_meals where type='Комплект' and class='Эконом' and flight_id = fl.flight_id and flight_date=fl.flight_date) as econom_meal,
fl.business as business_load,
(select sum(qty) from billed_meals where type='Комплект' and class='Бизнес' and flight_id = fl.flight_id and flight_date=fl.flight_date) as business_meal,
fl.crew as crew_load,
(select sum(qty) from billed_meals where type='Комплект' and class='Экипаж ВС' and flight_id = fl.flight_id and flight_date=fl.flight_date) as crew_meal

from flight_load fl, billed_meals m where m.flight_load_id=fl.id group by fl.id;

SELECT `fl`.`flight_id`, `fl`.`flight_date`, `econom` AS `econom_load`, (select sum(qty) from billed_meals where type='Комплект' and class='Эконом' and flight_id = fl.flight_id and flight_date=fl.flight_date) as econom_meal, `fl`.`business` AS `business_load`, (select sum(qty) from billed_meals where type='Комплект' and class='Бизнес' and flight_id = fl.flight_id and flight_date=fl.flight_date) as business_meal, `fl`.`crew` AS `crew_load`, (select sum(qty) from billed_meals where type='Комплект' and class='Экипаж ВС' and flight_id = fl.flight_id and flight_date=fl.flight_date) as crew_meal FROM `flight_load` `fl`, `billed_meals` `m` WHERE m.flight_load_id=fl.id GROUP BY `fl`.`id` LIMIT 10
*/

         /*$query = new Query;
         // compose the query
         $query->select("
            fl.flight_id,
            fl.flight_date,
            econom as econom_load,
            (select sum(qty) from billed_meals where type='Комплект' and class='Эконом' and flight_id = fl.flight_id and flight_date=fl.flight_date) as econom_meal,
            fl.business as business_load,
            (select sum(qty) from billed_meals where type='Комплект' and class='Бизнес' and flight_id = fl.flight_id and flight_date=fl.flight_date) as business_meal,
            fl.crew as crew_load,
            (select sum(qty) from billed_meals where type='Комплект' and class='Экипаж ВС' and flight_id = fl.flight_id and flight_date=fl.flight_date) as crew_meal
            ")
             ->from('flight_load fl, billed_meals m')
             ->where('m.flight_load_id=fl.id')
             ->groupBy('fl.id')
             ->orderBy('fl.flight_id asc');
             //->limit(10);

        //print_r($query->createCommand()->getRawSql());die;

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => [
                'pageSize' => 15,
            ],
        ]);*/

        //$query = FlightLoad::find(1)->all();

        //$query = FlightLoad::find()->select('flight.*, flight_load.id')->leftJoin('flight', 'flight_load.flight_id = flight.id')->where(['flight.id' => 1])->all();//->innerJoinWith('flight_meals')->all();
        //$query = FlightLoad::find()->leftJoin('flight', 'flight_load.flight_id = flight.id')->where(['flight.id' => 1])->all();//->innerJoinWith('flight_meals')->all();
        //$query = FlightLoad::find()->select('flight.from')->innerJoin('flight')->where(['flight.id' => 1])->all();

        //$query = FlightLoad::find()->with('flight')->where(['flight_id' => 1])->all(); pred($query[0]->flight[0]->from);

        //$query = FlightLoad::find()->joinWith('flight')->where(['flight.id' => 1])->all();        pred($query[0]->flight[0]->from);

        //$query = FlightLoad::find()->joinWith('billedMeals')->where(['flight_load.flight_id' => 1])->all();        pred($query[0]->billedMeals);
        //select(['flight.*', 'flight_load.*'])->

        //$query = FlightLoad::find()->joinWith('billedMeals')->where(['billed_meals.id' => 1])->all(); pred($query[0]->billedMeals[0]->type);

        //$query = FlightLoad::find()->joinWith('billedMeals')->where(['billed_meals.type' => 'Блюдо'])->all();
        //$query = FlightLoad::find()->joinWith('billedMeals')->where(['like','billed_meals.type','Блюдо'])->all();

        //$query = FlightLoad::find()->joinWith('billedMeals')->where(['like','billed_meals.type','Блюдо'])->limit(10)->all();
        //$query = FlightLoad::find()->joinWith('billedMeals')->where(['like','billed_meals.type','Блюдо'])->limit(100)->all();

        //$query->where(['billed_meals.type' => 'Блюдо']);
        //$query->where(['like','billed_meals.type','Блюдо']);
        //pred($query[0]->billedMeals);


        //print_r(Yii::$app->request->queryParams); die;
        $searchModel = new GridSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('grid', [
            'searchModel'   => $searchModel,
            'dataProvider'  => $dataProvider,
            'gridSearch'    => isset(Yii::$app->request->queryParams['GridSearch']) ? Yii::$app->request->queryParams['GridSearch'] : '',
            'pageSize' => 10
        ]);
    }

    /**
     * Logs in a user.
     *
     * @return mixed
     */
    public function actionLogin()
    {
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goBack();
        } else {
            return $this->render('login', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Logs out the current user.
     *
     * @return mixed
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }

    /**
     * Displays contact page.
     *
     * @return mixed
     */
    public function actionContact()
    {
        $model = new ContactForm();
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            if ($model->sendEmail(Yii::$app->params['adminEmail'])) {
                Yii::$app->session->setFlash('success', 'Thank you for contacting us. We will respond to you as soon as possible.');
            } else {
                Yii::$app->session->setFlash('error', 'There was an error sending your message.');
            }

            return $this->refresh();
        } else {
            return $this->render('contact', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Displays about page.
     *
     * @return mixed
     */
    public function actionAbout()
    {
        return $this->render('about');
    }

    /**
     * Signs user up.
     *
     * @return mixed
     */
    public function actionSignup()
    {
        $model = new SignupForm();
        if ($model->load(Yii::$app->request->post())) {
            if ($user = $model->signup()) {
                if (Yii::$app->getUser()->login($user)) {
                    return $this->goHome();
                }
            }
        }

        return $this->render('signup', [
            'model' => $model,
        ]);
    }

    /**
     * Requests password reset.
     *
     * @return mixed
     */
    public function actionRequestPasswordReset()
    {
        $model = new PasswordResetRequestForm();
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            if ($model->sendEmail()) {
                Yii::$app->session->setFlash('success', 'Check your email for further instructions.');

                return $this->goHome();
            } else {
                Yii::$app->session->setFlash('error', 'Sorry, we are unable to reset password for the provided email address.');
            }
        }

        return $this->render('requestPasswordResetToken', [
            'model' => $model,
        ]);
    }

    /**
     * Resets password.
     *
     * @param string $token
     * @return mixed
     * @throws BadRequestHttpException
     */
    public function actionResetPassword($token)
    {
        try {
            $model = new ResetPasswordForm($token);
        } catch (InvalidParamException $e) {
            throw new BadRequestHttpException($e->getMessage());
        }

        if ($model->load(Yii::$app->request->post()) && $model->validate() && $model->resetPassword()) {
            Yii::$app->session->setFlash('success', 'New password saved.');

            return $this->goHome();
        }

        return $this->render('resetPassword', [
            'model' => $model,
        ]);
    }
}
