<?php

namespace app\modules\yii2pjax\controllers;

use Yii;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use app\modules\yii2pjax\models\PhpVersion;
use app\modules\yii2pjax\models\PhpVersionSearch;

/**
 * PhpVersionController implements the CRUD actions for PhpVersion model.
 */
class PhpVersionController extends Controller
{

    /**
     * Lists all PhpVersion models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new PhpVersionSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single PhpVersion model.
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
     * Finds the PhpVersion model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return PhpVersion the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = PhpVersion::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    public function actionTest()
    {
        $schema = PhpVersion::getDB()->schema;
        print_r($schema->tableNames);
    }
}
