<?php

namespace frontend\controllers;

use Yii;
use frontend\models\Presentations;
use frontend\models\PresentationsSearch;
use frontend\models\PresentationSpecs;
use frontend\models\PresentationSpecModels;
use frontend\models\PresentationMethods;
use frontend\models\PresentationLocations;
use frontend\models\PresentationIssues;
use frontend\models\PresentationImages;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * PresentationsController implements the CRUD actions for Presentations model.
 */
class PresentationsController extends Controller
{
    public $layout='forms';

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
     * Lists all Presentations models.
     * @return mixed
     */
    public function actionIndex()
    {
        $this->layout = '/provider_services';

        $searchModel = new PresentationsSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Presentations model.
     * @param string $id
     * @return mixed
     */
    public function actionView($id)
    {
        $this->layout = '/presentation';

        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Presentations model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    { 
        if($ps = Yii::$app->request->post('Presentations')){
            $service = $this->findService($ps['service_id']);
            if($service){
                $object_model = !empty($ps['object_models']) ? $this->findObjectModel($ps['object_models']) : null;
                
                $model = new Presentations();
                $model->service = $service;
                $model_specs = new PresentationSpecs();
                $model_spec_models = new PresentationSpecModels();
                $model_methods = $this->loadPresentationMethods($service);
                $model_images = new PresentationImages();
                $model_issues = new PresentationIssues();
                $model_locations = new PresentationLocations();

                if ($model->load(Yii::$app->request->post()) && $model->save()) {
                    return $this->redirect(['view', 'id' => $model->id]);
                } else {
                    return $this->render('create', [
                        'service' => $service,
                        'model' => $model,
                        'model_specs' => $model_specs,
                        'model_spec_models' => $model_spec_models,
                        'model_methods' => $model_methods,
                        'model_images' => $model_images,
                        'model_issues' => $model_issues,
                        'model_locations' => $model_locations,
                        'object_model' => $object_model,
                    ]);
                }
                
            } else {
                return $this->goBack();
            }                
        } else {
            return $this->goBack();
        }                
    }

    /**
     * Updates an existing Presentations model.
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
     * Deletes an existing Presentations model.
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
     * Finds the Presentations model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $id
     * @return Presentations the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Presentations::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    /**
     * Finds the Presentations model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $id
     * @return Presentations the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findService($id)
    {
        if (($model = \frontend\models\CsServices::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    /**
     * Finds the Presentations model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $id
     * @return Presentations the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findObjectModel($id)
    {
        if (($model = \frontend\models\CsObjects::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    protected function loadPresentationMethods($service)
    {
        if($service->serviceMethods!=null) {
            foreach($service->serviceMethods as $serviceMethod) {
                if($serviceMethod->method) {
                    if($serviceMethod->method->property) { 
                        $property = $serviceMethod->method->property;
                        $model_methods[$property->id] = new \frontend\models\PresentationMethods();
                        $model_methods[$property->id]->serviceMethod = $serviceMethod->method;
                        $model_methods[$property->id]->property = $property;
                        $model_methods[$property->id]->service = $service;
                    }
                }           
            }
            return $model_methods;
        }
        return null;
    }
}
