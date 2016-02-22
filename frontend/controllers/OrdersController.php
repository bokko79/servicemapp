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
use frontend\models\OrderSkills;
use frontend\models\OrderServices;
use frontend\models\OrderServiceObjectmodels;
use frontend\models\OrderServiceSpecs;
use frontend\models\OrderServiceSpecModels;
use frontend\models\OrderServiceMethods;
use frontend\models\OrderServiceImages;
use frontend\models\OrderServiceIssues;
use frontend\models\Log;
use frontend\models\UserLog;
use frontend\models\UserLocations;
use frontend\models\UserObjects;
use frontend\models\UserObjectImages;
use frontend\models\UserObjectSpecs;
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
                $key = (isset($session['cart']['industry'])) ? count($session['cart']['industry'][$service->industry_id]['data'])+1 : 1;
                $model = new \frontend\models\CartForm();
                $model->service = $service;
                $model->object_models = $object_models;
                $model->key = $key;
                $image = [new Images()];
                $user_object = new UserObjects();
                $user_object_images = new UserObjectImages();
                $user_object_specs = new UserObjectSpecs();

                $no_skill = ($service->industry->skills && !isset($session['cart']) && $session['cart']['industry'][$service->industry_id]==null) ? 0 : 1;
                $no_method = ($service->serviceMethods) ? 0 : 1; 
                $no_spec = ($service->serviceSpecs!=null) ? 0 : 1;
                $no_pic = ($service->pic==1 && $service->service_object!=1) ? 0 : 1;
                $no_issue = ($service->service_type==3 && $service->object->issues!=null) ? 0 : 1;
                $no_amount = ($service->amount!=0) ? 0 : 1;
                $no_consumer = ($service->consumer!=0) ? 0 : 1;

                // method model
                $model_method = $this->loadServiceMethods($service, $key);
                // specification model
                $model_spec = $this->loadServiceSpecifications($service, $object_models, $key);                    
                        
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
                    'objects' => $this->getObjectModels($object_models),                    
                    'serviceSpecs' => $service->serviceSpecs,
                    'objectSpecifications' => $this->objectSpecifications($service, $object_models),
                    'userObjects' => $this->checkUserObjectsExist($service, $object_models),
                    'serviceMethods' => $service->serviceMethods,
                    'no_skill' => $no_skill,
                    'no_method' => $no_method, 
                    'no_spec' => $no_spec,
                    'no_pic' => $no_pic,
                    'no_issue' => $no_issue,
                    'no_amount' => $no_amount,
                    'no_consumer' => $no_consumer,
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
        $session = Yii::$app->session;
        if($session['cart']!=null) {
            foreach($session['cart']['industry'] as $ind){
                $service_id = $ind['data'][1]['service']; // regulatorna usluga
                break;
            }
            $cart = $session['cart']['industry'];
            $service = \frontend\models\CsServices::findOne($service_id);
            $objects = $this->getObjectModels($cart[$service->industry_id]['data'][1]['object_models']);           

            $model = new Orders();
            $model->service = $service;
            $location = new Locations();
            $location_end = new Locations();
            
            $notification = new Notifications();
            $log = new Log();
            $user_log = new UserLog();          

            $no_location = ($service->location!=0) ? 0 : 1;
            $no_time = ($service->time!=0) ? 0 : 1;
            $no_freq = ($service->frequency!=0) ? 0 : 1;

            if ($model->load(Yii::$app->request->post())) { 
                $activity = Activities::loadActivity();
                if($activity->save()){ // new activity saved 
                    $model->activity_id = $activity->id;                   
                    // check locations
                    $this->saveOrderLocation($model, $location, $service);
                    if($service->location==2 || $service->location==4){
                        $this->saveOrderLocation($model, $location, $service);
                    }
                    if ($model->save()) {
                        $this->saveOrderSkills($model, $cart, $service);
                        $this->saveOrderServices($model, $activity, $cart, $service);
                        return $this->redirect('/order/'.$model->id);                        
                    }
                                        
                } else {
                    return $this->redirect('/index');
                }

                return $this->redirect('/market');
                
            } else {
                return $this->render('create', [
                    'service' => $service,
                    'model' => $model,
                    'location'=> $location,
                    'location_end'=> $location_end,
                    'no_location' => $no_location,
                    'no_time' => $no_time,
                    'no_freq' => $no_freq,
                    'objects' => $objects,
                ]);
            }
        } else {
            return $this->redirect('/services');
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


    protected function loadServiceMethods($service, $key)
    {
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
            return $model_method;
        }
        return null;
    }

    protected function loadServiceSpecifications($service, $object_models, $key)
    {
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
        return (isset($model_spec)) ? $model_spec : null;
    }

    protected function objectSpecifications($service, $object_models)
    {
        if($object_models!=null || $service->serviceSpecs!=null) {
            foreach($service->serviceSpecs as $serviceSpec) {
                if($serviceSpec->spec) {
                    $objectSpecification[] = $serviceSpec->spec;
                }           
            }                
            foreach($object_models as $object_model) {
                $object = \frontend\models\CsObjects::findOne($object_model);
                if ($object) {
                    if ($object->specs) {
                        foreach($object->specs as $objectSpec) {
                            if(!in_array($objectSpec, $objectSpecification)){ 
                                $objectSpecification[] = $objectSpec;                               
                            }                                   
                        }
                    }           
                }       
            }           
        } 
        return (isset($objectSpecification)) ? $objectSpecification : null;
    }

    protected function getObjectModels($object_models=null)
    {
        if($object_models!=null){
            $object_container = [];
            foreach($object_models as $object_model) {
                $object = \frontend\models\CsObjects::findOne($object_model);
                if ($object) {
                    $object_container[] = $object;          
                }       
            }

            return $object_container;
        } 
        return null;           
    }

    protected function saveOrderServices($model, $activity, $cart, $service)
    {
        if($cart[$service->industry_id]['data']!=null){
            // order services
            foreach($cart[$service->industry_id]['data'] as $keyd=>$data){
                $model_services[$keyd] = new OrderServices();
                $model_services[$keyd]->activity_id = $activity->id;
                $model_services[$keyd]->order_id = $model->id;
                $model_services[$keyd]->service_id = $service->id;
                $model_services[$keyd]->provider_service_id = null;
                $model_services[$keyd]->title = $data['title'];
                $model_services[$keyd]->amount = $data['amount'];
                $model_services[$keyd]->amount_to = $data['amount_to'];
                $model_services[$keyd]->amount_operator = $data['amount_operator'];
                $model_services[$keyd]->consumer = $data['consumer'];
                $model_services[$keyd]->consumer_to = $data['consumer_to'];
                $model_services[$keyd]->consumer_children = $data['consumer_children'];
                $model_services[$keyd]->consumer_operator = $data['consumer_operator'];
                $model_services[$keyd]->issue_text = null;
                $model_services[$keyd]->note = $data['note'];
                $model_services[$keyd]->save();

                if($data['object_models']!=null){
                    foreach ($data['object_models'] as $key_o => $object_model) {
                        $model_service_objects[$key_o] = new OrderServiceObjectmodels();
                        $model_service_objects[$key_o]->order_service_id = $model_services[$keyd]->id;
                        $model_service_objects[$key_o]->object_id = $object_model;
                        $model_service_objects[$key_o]->save();
                    }
                }

                if($data['specifications']!=null){
                    foreach ($data['specifications'] as $key_s => $specification) {
                        if($specification['spec']!=null || $specification['spec_models']!=null){
                            $model_service_specs[$key_s] = new OrderServiceSpecs();
                            $model_service_specs[$key_s]->order_service_id = $model_services[$keyd]->id;
                            $model_service_specs[$key_s]->spec_id = $specification['objectSpec'];
                            $model_service_specs[$key_s]->value = $specification['spec'];
                            $model_service_specs[$key_s]->value_max = $specification['spec_to'];
                            $model_service_specs[$key_s]->value_operator = 'exact';
                            $model_service_specs[$key_s]->save();
                            if($specification['spec_models']!=null){
                                foreach($specification['spec_models'] as $key_sp=>$spec_model){
                                    $model_service_spec_models[$key_sp] = new OrderServiceSpecModels();
                                    $model_service_spec_models[$key_sp]->order_service_spec_id = $model_service_specs[$key_s]->id;
                                    $model_service_spec_models[$key_sp]->spec_model = $spec_model;
                                    $model_service_spec_models[$key_sp]->save();
                                }
                            }
                        }                             
                    }
                }

                if($data['methods']!=null){
                    foreach ($data['methods'] as $key_m => $method) {
                        $model_service_methods[$key_m] = new OrderServiceMethods();
                        $model_service_methods[$key_m]->order_service_id = $model_services[$keyd]->id;
                        $model_service_methods[$key_m]->method_id = $method['actionMethod'];
                        $model_service_methods[$key_m]->value = $method['method'];
                        $model_service_methods[$key_m]->save();
                    }
                }

                if($data['issues']!=null){
                    foreach ($data['issues'] as $key_is => $issue) {
                        $model_service_issues[$key_is] = new OrderServiceIssues();
                        $model_service_issues[$key_is]->order_service_id = $model_services[$keyd]->id;
                        $model_service_issues[$key_is]->object_issue_id = $issue;
                        $model_service_issues[$key_is]->save();
                    }
                }

                if($data['images']!=null){
                    foreach ($data['images'] as $key_im => $image) {
                        $model_service_images[$key_im] = new OrderServiceImages();
                        $model_service_images[$key_im]->order_service_id = $model_services[$keyd]->id;
                        $model_service_images[$key_im]->image_id = $image;
                        $model_service_images[$key_im]->save();
                    }
                }                             

            }
        } else {
            return false;
        }
    }

    protected function saveOrderSkills($model, $cart, $service)
    {
        // order skills
        if($cart[$service->industry_id]['skills']!=null){
            foreach($cart[$service->industry_id]['skills'] as $keysk=>$skill){
                $model_skills[$keysk] = new OrderSkills();
                $model_skills[$keysk]->order_id = $model->id;
                $model_skills[$keysk]->skill_id = $skill;
                $model_skills[$keysk]->save();
            }
        } else {
            return false;
        }
    }

    protected function saveOrderLocation($model, $location, $service)
    {
        if($model->loc_id==null && ($service->location==1 || $service->location==2 || $service->location==3 || $service->location==4)){
            if($location->load(Yii::$app->request->post())){
                $location->user_id = Yii::$app->user->id;
                if($location->save()){
                    $model->loc_id = $location->id;
                    $user_location = new UserLocations();
                    $user_location->loc_id=$location->id;
                    $user_location->user_id=Yii::$app->user->id;
                    $user_location->save();
                }
            }
            /*if(($service->location==1 && $model->loc_id==null) || ($service->location==2 && ($model->loc_id==null || $model->loc_id2==null))){                        
                    return $this->redirect('/new-order'); // redirect back
            }*/
        } else {
            return false;
        }
            
    }

    protected function saveOrderEndLocation($model, $location_end, $service)
    {
        if($model->loc_id2==null && ($service->location==2 || $service->location==4)){
            if($location_end->load(Yii::$app->request->post())){
                $location_end->user_id = Yii::$app->user->id;
                if($location_end->save()){
                    $model->loc_id2 = $location_end->id;
                    $user_location2 = new UserLocations();
                    $user_location2->loc_id=$location_end->id;
                    $user_location2->user_id=Yii::$app->user->id;
                    $user_location2->save();
                }
            }
            /*if($service->location==2 && ($model->loc_id==null || $model->loc_id2==null))){                        
                    return $this->redirect('/new-order'); // redirect back
            }*/
        } else {
            return false;
        }          
    }

    protected function checkUserObjectsExist($service, $object_models)
    {
        if(!Yii::$app->user->isGuest){
            $user = \frontend\models\User::findOne(Yii::$app->user->id);
            if($user->userObjects){
                foreach ($user->userObjects as $userObject){
                    if($userObject->object_id==$service->object_id || in_array($userObject->object_id, $object_models)){
                        $userObjects[] = $userObject;
                    }
                }
                return (isset($userObjects)) ? $userObjects : null;
            } else {
                return false;
            }            
        } else {
            return false;
        }        
    }
        
}
