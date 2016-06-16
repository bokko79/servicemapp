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
use frontend\models\OrderIndustryProperties;
use frontend\models\OrderServices;
use frontend\models\OrderServiceObjectModels;
use frontend\models\OrderServiceObjectProperties;
use frontend\models\OrderServiceObjectPropertyValues;
use frontend\models\OrderServiceActionProperties;
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
    public function actionModels($title=null)
    {
        if (isset($title) && ($ser_tr = $this->findServiceByTitle($title))) {
            $service = $this->findService($ser_tr->service_id);
            $key = (isset(Yii::$app->session['cart']['industry'][$service->industry_id]['data']) && Yii::$app->session['cart']['industry'][$service->industry_id]['data']!=null) ? count(Yii::$app->session['cart']['industry'][$service->industry_id]['data'])+1 : 1;
                             
            
            return $this->render('models', [
                'service' => $service,
            ]);

        } else {
            return $this->redirect('/services');
        }
    }

    /**
     * Adds a Service to an Order Cart.
     * @return mixed
     */
    public function actionAdd($title=null)
    {
        if (isset($title) and $service = $this->findServiceByTitle($title)) {
            $object_models = (Yii::$app->request->get('CsObjects')) ? Yii::$app->request->get('CsObjects')['id'] : null;
            $products = (Yii::$app->request->get('CsProducts')) ? Yii::$app->request->get('CsProducts')['id'] : null;
            $presentation = (Yii::$app->request->get('Presentations')) ? $this->findPresentation(Yii::$app->request->get('Presentations')['id']) : null;
            //service = $this->findService($ser_tr->service_id);
            $key = (isset(Yii::$app->session['cart']['industry'][$service->industry_id]['data']) && Yii::$app->session['cart']['industry'][$service->industry_id]['data']!=null) ? count(Yii::$app->session['cart']['industry'][$service->industry_id]['data'])+1 : 1;
            
            $model = $this->loadCartFormModel($service, $object_models, $key, $products, $presentation);            
            // method model
            $model_action_properties = $this->loadServiceActionProperties($service, $key);
            // specification model
            $model_object_properties = $this->loadServiceObjectProperties($service, $object_models, $products, $key);                                   
                    
            if($model->load(Yii::$app->request->post()) and $model->storeToCart()) {
                if($model_action_properties!=null){ // methods
                    if(yii\base\Model::loadMultiple($model_action_properties, Yii::$app->request->post()) and yii\base\Model::validateMultiple($model_action_properties)) {
                        foreach ($model_action_properties as $model_action_property) {
                            $model_action_property->store();
                        }
                    }
                }
                if($model_object_properties!=null and ($model->user_object=='' or $model->user_object==null)){ // specifications
                    if(yii\base\Model::loadMultiple($model_object_properties, Yii::$app->request->post()) and yii\base\Model::validateMultiple($model_object_properties)) {
                        foreach ($model_object_properties as $model_object_property) {
                            $model_object_property->store();
                        }
                    }
                }
                if ($model->imageFiles) {
                    $model->upload();
                }
                if(isset($_POST['searchPresentationIndex']) and $_POST['searchPresentationIndex']==''){                 
                    return $this->redirect($this->addParamsForPresentationIndex($model_object_properties, $model_action_properties, $model, $service));
                }
                if(isset($_POST['addMoreServices']) and $_POST['addMoreServices']==''){
                    return $this->redirect(['/services', 'i'=>$service->industry_id]);
                }
                return $this->redirect(['/new-order', 'industry'=>$service->industry_id]);                
            } else {
                return $this->render('add', [
                    'model' => $model,
                    'model_object_properties' => $model_object_properties,
                    'model_action_properties' => $model_action_properties,                    
                    'service' => $service,
                    'object_models' => $object_models,
                    'objects' => $this->getObjectModels($object_models),
                    'serviceObjectProperties' => $service->serviceObjectProperties,
                    'objectProperties' => $this->objectProperties($service, $object_models, $products),
                    'userObjects' => $this->checkUserObjectsExist($service, $object_models),
                    'serviceActionProperties' => $service->serviceActionProperties,
                ]);
            }  
        } else {
            return $this->redirect('/services');
        }
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
            // skill model
            $model_skill = $this->loadServiceSkills($service);
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
                    'model_skills' => $model_skill,
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
     * Displays a single Orders model.
     * @param string $id
     * @return mixed
     */
    public function actionEmptyCart()
    {        

        $session = Yii::$app->session;
        if($cart = $session['cart']){
            /*if(isset($cart['industry']) and $cart['industry']!=null){
                foreach($cart['industry'] as $ki=>$industry){                    
                    if(isset($industry[$ki]['data']['images']) && $industry[$ki]['data']['images']!=null){
                        foreach ($industry[$ki]['data']['images'] as $key_im => $image) {
                            $imageInstance = \frontend\models\Images::getImageByBaseEncode($image->name);
                            if($imageInstance){
                                $thumb = '@webroot/images/orders/thumbs/'.$imageInstance->ime;
                                $full = '@webroot/images/orders/full/'.$imageInstance->ime;
                                $docs = '@webroot/images/orders/docs/'.$imageInstance->ime;
                                $image = '@webroot/images/orders/'.$imageInstance->ime;
                                if($imageInstance->type=='image'){
                                    unlink(Yii::getAlias($thumb));
                                    unlink(Yii::getAlias($full));
                                    unlink(Yii::getAlias($image));
                                } else{
                                    unlink(Yii::getAlias($docs));
                                }
                                $imageInstance->delete();
                            }
                        }
                    }                    
                }                    
            }*/
        }

        $session->remove('cart');
        
        return $this->redirect('/services');
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
            $service = $this->findService($model->service_id);
            return $service;
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
     * Finds the CsServicesTranslation model based on its translated title.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return CsServices the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findObject($id)
    {
        if (($model = \frontend\models\CsObjects::findOne($id)) !== null) {
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
    protected function findPresentation($id)
    {
        if (($model = \frontend\models\Presentations::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }   

    /**
     * Izlistava izabrane modele izabranog predmeta usluga.
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
     * Izlistava izabrane proizvode izabranog predmeta usluga.
     */
    protected function getProducts($products=null)
    {
        if($products!=null){
            $product_container = [];
            foreach($products as $product_m) {
                $product = \frontend\models\CsProducts::findOne($product_m);
                if ($product) {
                    $product_container[] = $product;          
                }       
            }
            return $product_container;
        } 
        return null;           
    }

    /**
     * Izlistava sve specifikacije izabranih predmeta usluga i modela predmeta.
     */
    protected function objectProperties($service, $object_models, $products)
    {
        if($object_models!=null or $products!=null or $service->serviceObjectProperties!=null) {
           /*$object = $service->object;
            $class = $object->class;
            $level = $object->level;*/
            // if part: parts properties + container's own and inherited properties + container model/product properties
            /*if($class=='part'){
                $part = $object;
                $container = $service->partContainer;
            }*/
            // if model: models properties + objects public/protected properties + inherited properties // filtered through services object properties
            $objectProperties = [];
            if($object_models and count($object_models)==1){
                foreach($object_models as $object_model) {
                    $object_m = \frontend\models\CsObjects::findOne($object_model);
                    if ($object_m and $object_m->objectProperties) {
                        foreach($object_m->objectProperties as $object_mProperty) {
                            //if(!in_array($object_mProperty->id, $objectSpecification)){ 
                                $objectProperties[] = $object_mProperty;                               
                            //}                                   
                        }     
                    }       
                }
            }

            if($service->serviceObjectProperties!=null){
                foreach($service->serviceObjectProperties as $serviceObjectProperty) { // all servicespecs
                    // we need only specs for this service and this/these object_models

                    if(!in_array($serviceObjectProperty->object_property_id, $objectProperties)) {
                        $objectProperties[] = $serviceObjectProperty->objectProperty;
                    }           
                } 
            }

            // if object: object's and inherited properties // filtered through services object properties

            // if products: product properties + inherited + object's and inherited properties // filtered through services object properties

            // filtered through services object properties
            /*if ($object = $service->object) {
                if ($object->objectProperties) {
                    foreach($object->objectProperties as $objectProperty) {
                        if($objectProperty->property_class!='private'){
                            $objectSpecification[] = $objectProperty->id;
                        }                                                                                          
                    }
                }           
            }
            
            if(isset($objectSpecification) and $objectSpecification) {
                
            }*/
        } 
        return (isset($objectProperties)) ? $objectProperties : null;
    }

    /**
     * Kreira Modele CartServiceObjectSpecification za sve izabrane specifikacije.
     */
    protected function loadServiceObjectProperties($service, $object_models, $products, $key)
    {
        $objectProperties = $this->objectProperties($service, $object_models, $products);
        if($objectProperties!=null){
            /*echo '<pre>';
                print_r($objectProperties); die();*/
            foreach($objectProperties as $objectProperty) {                
                if($property = $objectProperty->property) {
                    $model_object_property[$property->id] = new \frontend\models\CartServiceObjectProperties();
                    $model_object_property[$property->id]->objectProperty = $objectProperty;
                    $model_object_property[$property->id]->property = $property;
                    $model_object_property[$property->id]->service = $service;
                    $model_object_property[$property->id]->key = $key;
                    $model_object_property[$property->id]->checkUserObject = ($this->checkUserObjectsExist($service, $object_models)) ? 0 : 1;
                    $model_object_property[$property->id]->checkIfRequired = ($objectProperty->required==1) ? 1 : 0;
                }
            }
            return (isset($model_object_property)) ? $model_object_property : null;
        }
        return null;        
    } 

    protected function loadServiceActionProperties($service, $key)
    {
        if($service->serviceActionProperties!=null) {
            foreach($service->serviceActionProperties as $serviceActionProperty) {
                if($actionProperty = $serviceActionProperty->actionProperty) {
                    if($property = $actionProperty->property) { 
                        $model_action_property[$property->id] = new \frontend\models\CartServiceActionProperties();
                        $model_action_property[$property->id]->serviceActionProperty = $serviceActionProperty;
                        $model_action_property[$property->id]->actionProperty = $actionProperty;
                        $model_action_property[$property->id]->property = $property;
                        $model_action_property[$property->id]->service = $service;
                        $model_action_property[$property->id]->key = $key;
                    }
                }           
            }
            return $model_action_property;
        }
        return null;
    }

    protected function loadServiceIndustryProperties($service)
    {
        if($serviceIndustryProperties = $service->serviceIndustryProperties) {
            foreach($serviceIndustryProperties as $serviceIndustryProperty) {
                if($industryProperty = $serviceIndustryProperty->industryProperty) {
                    if($property = $industryProperty->property) { 
                        $model_industryProperty[$property->id] = new \frontend\models\OrderIndustryProperties();
                        $model_industryProperty[$property->id]->serviceIndustryProperty = $industryProperty;
                        $model_industryProperty[$property->id]->property = $property;
                        $model_industryProperty[$property->id]->service = $service;
                        //$model_industryProperty[$property->id]->key = $key;
                    }
                }           
            }
            return $model_industryProperty ? $model_industryProperty : null;
        }
        return null;
    }

    /**
     * Kreira Modele CartServiceObjectSpecification za sve izabrane specifikacije.
     */
    protected function loadCartFormModel($service, $object_models, $key, $products, $presentation)
    {
        if($service and $key){
            $model = new \frontend\models\CartForm();
            $model->service = $service;
            $model->object_models = $object_models;
            $model->key = $key;
            $model->type = $presentation ? 'direct' : 'global';
            $model->presentation = $presentation ? $presentation : null;
            $model->checkUserObject = ($this->checkUserObjectsExist($service, $object_models)) ? 1 : 0;
            $model->imageFiles = UploadedFile::getInstances($model, 'imageFiles');

            return (isset($model)) ? $model : null;
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

    protected function addParamsForPresentationIndex($model_spec, $model_method, $model, $service)
    {
        if($model_method and $model_spec and $model and $service){
           if($model_spec!=null){
                foreach ($model_spec as $keys => $m_spec) {
                    if($m_spec['spec_models'] or $m_spec['spec_models']==''){
                        if(is_array($m_spec['spec_models'])){
                            foreach ($m_spec['spec_models'] as $keym => $mSpecModel) {
                                $arrayParams['PresentationSpecs['.$keys.'][spec_models]'][]=$mSpecModel;
                            } 
                        } else {
                            $arrayParams['PresentationSpecs['.$keys.'][spec_models]']=$m_spec['spec_models'];
                        }                                                                       
                    } else {
                        $arrayParams['PresentationSpecs['.$keys.'][value_operator]']=$m_spec['spec_operator'];
                        $arrayParams['PresentationSpecs['.$keys.'][value]']=$m_spec['spec'];
                    }
                    $arrayParams['PresentationSpecs['.$keys.'][spec_id]']=$m_spec->specification->id;
                }
            }
            if($model_method!=null){
                //echo '<pre>';
                //print_r($model_method); die();
                foreach ($model_method as $keys => $m_method) {
                    if($m_method['method_models'] or $m_method['method_models']==''){
                        if(is_array($m_method['method_models'])){
                            foreach ($m_method['method_models'] as $keym => $mMethodModel) {
                                $arrayParams['PresentationMethods['.$keys.'][method_models]'][]=$mMethodModel;
                            } 
                        } else {
                            $arrayParams['PresentationMethods['.$keys.'][method_models]']=$m_method['method_models'];
                        }                                                                       
                    } else {
                        $arrayParams['PresentationMethods['.$keys.'][value]']=$m_method['method'];
                    }
                    $arrayParams['PresentationMethods['.$keys.'][method_id]']=$m_method->serviceMethod->id;
                }
            }

            $arrayParams['PresentationsSearch[service_id]']=$service->id; 
            $arrayParams['PresentationsSearch[quantity]']=$model->amount;
            $arrayParams['PresentationsSearch[quantity_operator]']=$model->amount_operator;
            $arrayParams['PresentationsSearch[consumer]']=$model->consumer;
            $arrayParams['PresentationsSearch[consumer_operator]']=$model->consumer_operator;
            $arrayParams['PresentationsSearch[title]']=$model->title;
            return array_merge(['/presentations'], $arrayParams); 
        }
        return;
    }      
}
