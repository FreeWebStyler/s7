<?php

namespace app\modules\simplegridview\controllers;

use yii\web\Controller;
use Yii;
use app\modules\simplegridview\models\Category;
use app\modules\simplegridview\models\CategorySearch;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;

class DefaultController extends Controller
{
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['post'],
                ],
            ],
        ];
    }
    public function actionIndex()
    {
        $searchModel = new CategorySearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Category model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Category model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Category();

        if ($model->load(Yii::$app->request->post())) {

            $uploadedFile = UploadedFile::getInstance($model, 'tmpImage');
            if ($uploadedFile !== null) {
                $path = Yii::$app->params['uploadPath']
                    . Yii::$app->security->generateRandomString()
                    . '.' . $uploadedFile->extension;
                $model->category_image = $path;
                if ($model->validate()) {
                    $uploadedFile->saveAs(mb_substr($model->category_image, 1));
                }
            }
            if ($model->save()) {
                if ($uploadedFile !== null) {
                }
                return $this->redirect(['index']);
            } else {

            }
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Category model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post())) {

            $uploadedFile = UploadedFile::getInstance($model, 'tmpImage');
            if ($uploadedFile) {
                $path = Yii::$app->params['uploadPath']
                    . Yii::$app->security->generateRandomString()
                    . '.' . $uploadedFile->extension;
                $model->category_image = $path;
                if ($model->validate()) {
                    $uploadedFile->saveAs(mb_substr($model->category_image, 1));
                }
            }
            if ($model->save()) {
                return $this->redirect(['index']);
            } else {

            }
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Category model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $file = mb_substr($this->findModel($id)->category_image,1);
        if ($this->findModel($id)->delete())
        {
            unlink($file);
        }

        return $this->redirect(['index']);
    }

    /**
     * Finds the Category model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Category the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Category::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
