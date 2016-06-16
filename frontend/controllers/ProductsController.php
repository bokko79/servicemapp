<?php

namespace frontend\controllers;

use Yii;
use frontend\models\CsProducts;
use frontend\models\CsProductsSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * ProductController implements the CRUD actions for CsProducts model.
 */
class ProductsController extends Controller
{
    public $layout='index';

    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all CsProducts models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new CsProductsSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single CsProducts model.
     * @param string $id
     * @return mixed
     */
    public function actionView($title)
    {
        return $this->render('view', [
            'model' => $this->findModelByTitle($title),
        ]);
    }

    /**
     * Displays a single CsProducts model.
     * @param string $id
     * @return mixed
     */
    public function actionCompare($title, $title2)
    {
        return $this->render('compare', [
            'model' => $this->findModelByTitle($title),
            'model2' => $this->findModelByTitle($title2),
        ]);
    }

    /**
     * Finds the CsProducts model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $id
     * @return CsProducts the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = CsProducts::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    /**
     * Finds the CsServicesTranslation model based on its translated title.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return CsServices the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModelByTitle($title)
    {
        if (($model = \frontend\models\CsProducts::find()->where('name=:name', [':name'=>str_replace('-', ' ', $title)])->one()) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
