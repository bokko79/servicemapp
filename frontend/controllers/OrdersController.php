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
use frontend\models\UserObjectSpecModels;
use frontend\models\Locations;
use frontend\models\Images;
use frontend\models\Notifications;
//use common\models\LoginForm;
use frontend\models\PasswordResetRequestForm;
use frontend\models\ResetPasswordForm;
use common\models\SignupForm;
use yii\web\UploadedFile;
use dektrium\user\models\User;
use dektrium\user\models\LoginForm;
use dektrium\user\models\RegistrationForm;
use dektrium\user\models\RegistrationProviderForm;
use dektrium\user\traits\AjaxValidationTrait;

/**
 * OrdersController implements the CRUD actions for Orders model.
 */
class OrdersController extends Controller
{
    use AjaxValidationTrait;

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
        if (isset($title) && ($ser_tr = $this->findServiceByTitle($title))) {
            $object_models = (Yii::$app->request->post('CsObjects')) ? Yii::$app->request->post('CsObjects')['id'] : null;
            $service = $this->findService($ser_tr->service_id);
            $key = (isset(Yii::$app->session['cart']['industry'][$service->industry_id]['data']) && Yii::$app->session['cart']['industry'][$service->industry_id]['data']!=null) ? count(Yii::$app->session['cart']['industry'][$service->industry_id]['data'])+1 : 1;
            
            $model = new \frontend\models\CartForm();
            $model->service = $service;
            $model->object_models = $object_models;
            $model->key = $key;
            $model->checkUserObject = ($this->checkUserObjectsExist($service, $object_models)) ? 1 : 0;
            $model->imageFiles = UploadedFile::getInstances($model, 'imageFiles');
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
                if($model_spec!=null && ($model->user_object=='' || $model->user_object==null)){ // specifications
                    if(yii\base\Model::loadMultiple($model_spec, Yii::$app->request->post()) && yii\base\Model::validateMultiple($model_spec)) {
                        foreach ($model_spec as $m_spec) {
                            if(!$m_spec->store()) {
                                return $this->goBack();
                            }
                        }
                    }
                }
                if ($model->imageFiles) {
                    if(!$model->upload()){
                        return $this->goBack();
                    }
                }
                return $this->redirect(['/new-order', 'industry'=>$service->industry_id]);
            } else {
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
                ]);
            }  
        } else {return $this->redirect('/services');}
    }

    /**
     * Displays a single Orders model.
     * @param string $id
     * @return mixed
     */
    public function actionView($id)
    {
        $this->layout = '//order';

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
        $industry = Yii::$app->request->get('industry');
        $process = Yii::$app->request->get('process');
        if(Yii::$app->session['cart']!=null && ($industry!=null || $process!=null)) {
            foreach(Yii::$app->session['cart']['industry'] as $key=>$ind){
                if($key==$industry){
                    $cart[$key] = $ind;
                }                
            }
            $service = \frontend\models\CsServices::findOne($cart[$industry]['data'][1]['service']);
            $objects = $this->getObjectModels($cart[$industry]['data'][1]['object_models']);
            $user = (!Yii::$app->user->isGuest) ? \frontend\models\User::findOne(Yii::$app->user->id) : null; // orderer
            $model = new Orders();
            $model->service = $service;            
            $location = new Locations();
            $location->control = $service->location;
            $location->userControl = (Yii::$app->user->isGuest) ? 0 : 1;
            $location_end = new Locations();
            $new_user = ($user==null) ? Yii::createObject(RegistrationProviderForm::className()) : null;  // register provider
            $returning_user = ($user==null) ? Yii::createObject(LoginForm::className()) : null; // login existing user

            if ($model->load(Yii::$app->request->post())) {
                if(Yii::$app->user->isGuest){
                    // register $ login user                    
                    if ($new_user->load(Yii::$app->request->post())) {
                        if ($user = $new_user->signup()) {
                            if (!Yii::$app->getUser()->login($user)) {
                                return $this->goBack();
                            }
                        }
                    }
                    // login user
                    if ($returning_user->load(Yii::$app->request->post())) {
                        if(!$returning_user->login()){
                            return $this->goBack();
                        }                        
                    }
                }
                // continue
                $activity = Activities::loadActivity(Yii::$app->user->id);
                if($activity->save()){ // new activity saved 
                    $model->activity_id = $activity->id;
                    $this->saveOrderLocation($model, $location, $service);
                    $this->saveOrderEndLocation($model, $location_end, $service);
                    if ($model->save()){
                        $this->saveOrderSkills($model, $cart, $service);
                        $this->saveOrderServices($model, $activity, $cart, $service);
                        $this->eraseSessionData($industry); // izbaci snimljene usluge iz korpe
                        return $this->redirect('/order/'.$model->id);                        
                    }                                        
                } else {
                    return $this->redirect('/services');
                }
                return $this->redirect('/services');                
            } else {
                return $this->render('create', [
                    'service' => $service,
                    'model' => $model,
                    'location'=> $location,
                    'location_end'=> $location_end,
                    'objects' => $objects,
                    'new_user' => $new_user,
                    'returning_user' => $returning_user,
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

    /**
     * Izlistava sve modele izabranih predmeta usluga.
     */
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

    /**
     * Izlistava sve specifikacije izabranih predmeta usluga i modela predmeta.
     */
    protected function objectSpecifications($service, $object_models)
    {
        if($object_models!=null || $service->serviceSpecs!=null) {
            if($service->serviceSpecs!=null){
               foreach($service->serviceSpecs as $serviceSpec) {
                    if($serviceSpec->spec) {
                        $objectSpecification[] = $serviceSpec->spec;
                    }           
                } 
            }
            if($object_models!=null){
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
        } 
        return (isset($objectSpecification)) ? $objectSpecification : null;
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

    /**
     * Kreira Modele CartServiceObjectSpecification za sve izabrane specifikacije.
     */
    protected function loadServiceSpecifications($service, $object_models, $key)
    {
        $objectSpecs = $this->objectSpecifications($service, $object_models);
        if($objectSpecs!=null){
            foreach($objectSpecs as $objectSpec) {
                if($objectSpec->property) {
                    $property = $objectSpec->property;
                    $model_spec[$property->id] = new \frontend\models\CartServiceObjectSpecification();
                    $model_spec[$property->id]->specification = $objectSpec;
                    $model_spec[$property->id]->property = $property;
                    $model_spec[$property->id]->service = $service;
                    $model_spec[$property->id]->key = $key;
                    $model_spec[$property->id]->checkUserObject = ($this->checkUserObjectsExist($service, $object_models)) ? 0 : 1;
                    $model_spec[$property->id]->checkIfRequired = ($objectSpec->required==1) ? 1 : 0;             
                }                                   
            }
            return (isset($model_spec)) ? $model_spec : null;
        }
        return null;        
    }    

    protected function saveOrderServices($model, $activity, $cart, $service)
    {
        if(isset($cart[$service->industry_id]['data']) && $cart[$service->industry_id]['data']!=null){
            // order services
            foreach($cart[$service->industry_id]['data'] as $keyd=>$data){
                $model_services[$keyd] = new OrderServices();
                $model_services[$keyd]->activity_id = $activity->id;
                $model_services[$keyd]->order_id = $model->id;
                $model_services[$keyd]->service_id = $data['service'];
                $model_services[$keyd]->provider_service_id = null;
                $model_services[$keyd]->title = $data['title'];
                $model_services[$keyd]->amount = $data['amount'];
                $model_services[$keyd]->amount_to = $data['amount_to'];
                $model_services[$keyd]->amount_operator = $data['amount_operator'];
                $model_services[$keyd]->consumer = $data['consumer'];
                $model_services[$keyd]->consumer_to = $data['consumer_to'];
                $model_services[$keyd]->consumer_children = $data['consumer_children'];
                $model_services[$keyd]->consumer_operator = $data['consumer_operator'];
                $model_services[$keyd]->issue_text = $data['issue_text'];
                $model_services[$keyd]->note = $data['note'];
                $model_services[$keyd]->save();

                if(isset($data['object_models']) && $data['object_models']!=null){
                    foreach ($data['object_models'] as $key_o => $object_model) {
                        $model_service_objects[$key_o] = new OrderServiceObjectmodels();
                        $model_service_objects[$key_o]->order_service_id = $model_services[$keyd]->id;
                        $model_service_objects[$key_o]->object_id = $object_model;
                        $model_service_objects[$key_o]->save();
                    }
                }

                if(isset($data['user_object']) && ($data['user_object']!='' || $data['user_object']!=null)){ // snimi iz USER OBJECT
                    $user_object = $data['user_object'];
                    $userObject = UserObjects::findOne($user_object);
                    if($userObject){
                        if($userObject->userObjectSpecs){
                            foreach($userObject->userObjectSpecs as $key_s=>$userObjectSpec){
                                $model_service_specs[$key_s] = new OrderServiceSpecs();
                                $model_service_specs[$key_s]->order_service_id = $model_services[$keyd]->id;
                                $model_service_specs[$key_s]->spec_id = $userObjectSpec->spec_id;
                                $model_service_specs[$key_s]->value = $userObjectSpec->value;
                                $model_service_specs[$key_s]->value_max = $userObjectSpec->value_max;
                                $model_service_specs[$key_s]->value_operator = $userObjectSpec->value_operator;
                                $model_service_specs[$key_s]->save();
                            }
                        }
                        if($userObject->userObjectImages){
                            foreach ($userObject->userObjectImages as $key_im => $userObjectImage) {
                                $model_service_images[$key_im] = new OrderServiceImages();
                                $model_service_images[$key_im]->order_service_id = $model_services[$keyd]->id;
                                $model_service_images[$key_im]->image_id = $userObjectImage->image_id;
                                $model_service_images[$key_im]->save();
                            }
                        }                        
                    }
                } else {
                    $user_object_model[$keyd] = new UserObjects();
                    $user_object_model[$keyd]->user_id = Yii::$app->user->id;
                    $user_object_model[$keyd]->object_id = (isset($data['object_models']) && $data['object_models']!=null) ? $data['object_models'][0] : $service->object_id;
                    $user_object_model[$keyd]->object_type_id = $service->object->object_type_id;
                    $user_object_model[$keyd]->ime = 'Moj '.$service->object->tName;
                    $user_object_model[$keyd]->loc_id = ($model->loc_id) ? $model->loc_id : null;
                    $user_object_model[$keyd]->note = null;
                    $user_object_model[$keyd]->is_set = 1;
                    $user_object_model[$keyd]->update_time = date('Y-m-d H:i:s');
                    $user_object_model[$keyd]->save();
                    if(isset($data['specifications']) && $data['specifications']!=null){ // SNIMI IZ PODESAVANJA IZ ADD SERVICE -> SPECIFICATIONS                        
                        foreach ($data['specifications'] as $key_s => $specification) {
                            if($specification['spec']!=null || $specification['spec_models']!=null){
                                $model_service_specs[$key_s] = new OrderServiceSpecs();
                                $model_service_specs[$key_s]->order_service_id = $model_services[$keyd]->id;
                                $model_service_specs[$key_s]->spec_id = $specification['objectSpec'];
                                $model_service_specs[$key_s]->value = $specification['spec'];
                                $model_service_specs[$key_s]->value_max = $specification['spec_to'];
                                $model_service_specs[$key_s]->value_operator = $specification['spec_operator'];
                                $model_service_specs[$key_s]->save();

                                $user_object_model_specs[$key_s] = new UserObjectSpecs();
                                $user_object_model_specs[$key_s]->user_object_id = $user_object_model[$keyd]->id;
                                $user_object_model_specs[$key_s]->spec_id = $specification['objectSpec'];
                                $user_object_model_specs[$key_s]->value = $specification['spec'];
                                $user_object_model_specs[$key_s]->value_max = $specification['spec_to'];
                                $user_object_model_specs[$key_s]->value_operator = $specification['spec_operator'];
                                $user_object_model_specs[$key_s]->save();
                                //
                                if($specification['spec_models']!=null){
                                    foreach($specification['spec_models'] as $key_sp=>$spec_model){
                                        $model_service_spec_models[$key_sp] = new OrderServiceSpecModels();
                                        $model_service_spec_models[$key_sp]->order_service_spec_id = $model_service_specs[$key_s]->id;
                                        $model_service_spec_models[$key_sp]->spec_model = $spec_model;
                                        $model_service_spec_models[$key_sp]->save();

                                        $user_object_model_spec_models[$key_sp] = new UserObjectSpecModels();
                                        $user_object_model_spec_models[$key_sp]->user_object_spec_id = $user_object_model_specs[$key_s]->id;
                                        $user_object_model_spec_models[$key_sp]->spec_model = $spec_model;
                                        $user_object_model_spec_models[$key_sp]->save();
                                    }
                                }
                            }                             
                        }
                    }
                    if(isset($data['images']) && $data['images']!=null){
                        foreach ($data['images'] as $key_im => $image) {
                            $imageInstance = \frontend\models\Images::getImageByName($image->name);
                            if($imageInstance!=null){
                                $model_service_images[$key_im] = new OrderServiceImages();
                                $model_service_images[$key_im]->order_service_id = $model_services[$keyd]->id;
                                $model_service_images[$key_im]->image_id = $imageInstance->id;
                                $model_service_images[$key_im]->save();

                                $user_object_model_images[$key_im] = new UserObjectImages();
                                $user_object_model_images[$key_im]->user_object_id = $user_object_model[$keyd]->id;
                                $user_object_model_images[$key_im]->image_id = $imageInstance->id;
                                $user_object_model_images[$key_im]->save();
                            }                                
                        }
                    }
                }

                if(isset($data['methods']) && $data['methods']!=null){
                    foreach ($data['methods'] as $key_m => $method) {
                        $model_service_methods[$key_m] = new OrderServiceMethods();
                        $model_service_methods[$key_m]->order_service_id = $model_services[$keyd]->id;
                        $model_service_methods[$key_m]->method_id = $method['actionMethod'];
                        $model_service_methods[$key_m]->value = $method['method'];
                        $model_service_methods[$key_m]->save();
                    }
                }

                if(isset($data['issues']) && $data['issues']!=null){
                    foreach ($data['issues'] as $key_is => $issue) {
                        $model_service_issues[$key_is] = new OrderServiceIssues();
                        $model_service_issues[$key_is]->order_service_id = $model_services[$keyd]->id;
                        $model_service_issues[$key_is]->object_issue_id = $issue;
                        $model_service_issues[$key_is]->save();
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
        if(!Yii::$app->user->isGuest && $object_models){
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

    protected function eraseSessionData($industry)
    {
        $session = Yii::$app->session;
        $cart = $session['cart'];
        unset($cart['industry'][$industry]);
        $session['cart'] = $cart;
        return;
    }        
}
