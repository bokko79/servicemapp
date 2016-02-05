<?php

namespace frontend\controllers;

use Yii;
use frontend\models\Activities;
use frontend\models\ActivitiesSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * ActivitiesController implements the CRUD actions for Activities model.
 */
class ActivitiesController extends Controller
{
    public $layout='market';

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

    /**
     * Lists all Activities models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new ActivitiesSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        if (isset($_REQUEST['CsServices']['industry_id']) && isset($_REQUEST['CsServices']['action_id']) && isset($_REQUEST['CsServices']['object_id'])){
            $service = \frontend\models\CsServices::find()->where('industry_id='.$_REQUEST['CsServices']['industry_id'].' and action_id='.$_REQUEST['CsServices']['action_id'].' and object_id='.$_REQUEST['CsServices']['object_id'])->one();
            //print_r($service); die();
            return $this->redirect('/add/'.mb_strtolower(str_replace(' ', '-', $service->name)));
        }        
        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Activities model.
     * @param string $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Activities model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Activities();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing Activities model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param string $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing Activities model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param string $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Activities model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $id
     * @return Activities the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Activities::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
