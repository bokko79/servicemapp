<?php

namespace frontend\controllers;

use Yii;
use frontend\models\Orders;
use frontend\models\OrdersSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\Request;
use frontend\models\Activities;
use frontend\models\OrderServices;
use frontend\models\OrderServiceSpecs;
use frontend\models\OrderServiceMethods;
use frontend\models\OrderServiceImages;
use frontend\models\OrderServiceIssues;
use frontend\models\Log;
use frontend\models\UserLog;
use frontend\models\Locations;
use frontend\models\Images;
use frontend\models\Notifications;

/**
 * OrdersController implements the CRUD actions for Orders model.
 */
class OrdersController extends Controller
{
    public $layout='forms';

    public $param_model;

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
     * Adds a Service to an Order Cart.
     * @return mixed
     */
    public function actionChoose()
    {
        if(Yii::$app->request->post()) {
            $post = Yii::$app->request->post('CsServices');
            $industry = $post['industry_id'];
            $action = $post['action_id'];
            $object = $post['object_id'];
            $service = \frontend\models\CsServices::find()->where('industry_id='.$industry.' and action_id='.$action.' and object_id='.$object)->one();
            if($service){
                return $this->redirect('add/'.mb_strtolower(str_replace(' ', '-', $service->name)));
            }
            
        }
        return $this->render('choose', [
            
        ]);            
    }

    /**
     * Adds a Service to an Order Cart.
     * @return mixed
     */
    public function actionAdd($title=null)
    {
        if (isset($title)) {
            $ser_tr = $this->findServiceByTitle($title);
            // ako je našao ime usluge, renderuj stranicu - URL injection
            if ($ser_tr)
            {
                $request = Yii::$app->request;
                $session = Yii::$app->session;
                $object_models = ($request->get('CsObjects')) ? $request->get('CsObjects')['id'] : null;
                

                $service = $this->findService($ser_tr->service_id);
                $key = (isset($session['cart']['industry'])) ? count($session['cart']['industry'][$service->industry_id])+1 : 1;
                $model = new \frontend\models\CartForm();
                $model->service = $service;
                $model->object_models = $object_models;
                $model->key = $key;

                // method model
                $model_method = null;
                if($service->serviceMethods!=null) {
                    foreach($service->serviceMethods as $serviceMethod) {
                        if($serviceMethod->method) {
                            if($serviceMethod->method->property) { 
                                $property = $serviceMethod->method->property;
                                $model_method[$property->id] = new \frontend\models\CartServiceActionMethod();
                                $model_method[$property->id]->serviceMethod = $serviceMethod->method;
                                $model_method[$property->id]->property = $property;
                                $model_method[$property->id]->service = $service;
                                $model_method[$property->id]->key = $key;
                            }
                        }           
                    }                   
                }
                // specification model
                $model_spec = null;
                if($object_models!=null || $service->serviceSpecs!=null) {
                    foreach($service->serviceSpecs as $serviceSpec) {
                        if($serviceSpec->spec) {
                            if($serviceSpec->spec->property) { 
                                $property = $serviceSpec->spec->property;
                                $model_spec[$property->id] = new \frontend\models\CartServiceObjectSpecification();
                                $model_spec[$property->id]->specification = $serviceSpec->spec;
                                $model_spec[$property->id]->property = $property;
                                $model_spec[$property->id]->service = $service;
                                $model_spec[$property->id]->key = $key;
                                $specific_properties[] = $property->id;
                            }
                        }           
                    }                
                    foreach($object_models as $object_model) {
                        $object = \frontend\models\CsObjects::findOne($object_model);
                        if ($object) {
                            if ($object->specs) {
                                foreach($object->specs as $objectSpec) {
                                    if($objectSpec->property) {
                                        $property = $objectSpec->property;
                                        if(!in_array($property->id, $specific_properties)){ 
                                            $model_spec[$property->id] = new \frontend\models\CartServiceObjectSpecification();
                                            $model_spec[$property->id]->specification = $objectSpec;
                                            $model_spec[$property->id]->property = $property;
                                            $model_spec[$property->id]->service = $service;
                                            $model_spec[$property->id]->key = $key;
                                            $specific_properties[] = $property->id;
                                        }
                                    }                                   
                                }
                            }           
                        }       
                    } 
                }                    
                        
                if($model->load(Yii::$app->request->post()) && $model->storeToCart()) {                          
                    if($model_method!=null){ // methods
                        if(yii\base\Model::loadMultiple($model_method, Yii::$app->request->post()) && yii\base\Model::validateMultiple($model_method)) {
                            foreach ($model_method as $m_method) {
                                if(!$m_method->store()) {
                                    return $this->goBack();
                                }
                            }
                        }
                    }
                    if($model_spec!=null){ // specifications
                        if(yii\base\Model::loadMultiple($model_spec, Yii::$app->request->post()) && yii\base\Model::validateMultiple($model_spec)) {
                            foreach ($model_spec as $m_spec) {
                                if(!$m_spec->store()) {
                                    return $this->goBack();
                                }
                            }
                        }
                    }

                    return $this->redirect('/new-order');
                }

                return $this->render('add', [
                    'model' => $model,
                    'model_specs' => $model_spec,
                    'model_methods' => $model_method,
                    'service' => $service,
                    'object_models' => $object_models,
                    'serviceSpecs' => $service->serviceSpecs,
                    'serviceMethods' => $service->serviceMethods,
                ]);
            } else {
                throw new NotFoundHttpException('The requested page does not exist.');
            }   
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    /**
     * Displays a single Orders model.
     * @param string $id
     * @return mixed
     */
    public function actionView($id)
    {
        $this->layout = '//product';

        $this->param_model = $this->findModel($id);
        
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Orders model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {        
        $activity = new Activities();
        $model = new Orders();
        $model_services = new OrderServices();
        $model_service_specs = new OrderServiceSpecs();
        $model_service_methods = new OrderServiceMethods();
        $model_service_issues = new OrderServiceIssues();
        $model_service_images = new OrderServiceImages();
        $image = new Images();
        $location = new Locations();
        $notification = new Notifications();
        $log = new Log();
        $user_log = new UserLog();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing Orders model.
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
     * Deletes an existing Orders model.
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
     * Finds the Orders model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $id
     * @return Orders the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Orders::findOne($id)) !== null) {
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
    protected function findServiceByTitle($title)
    {
        if (($model = \common\models\CsServicesTranslation::find()->where('name=:name and lang_code="SR"', [':name'=>str_replace('-', ' ', $title)])->one()) !== null) {
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
    protected function findService($id)
    {
        if (($model = \frontend\models\CsServices::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
