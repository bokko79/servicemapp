<?php

namespace frontend\controllers;

use Yii;
use yii\base\Model;
use yii\web\UploadedFile;
use frontend\models\ProviderServices;
use frontend\models\ProviderIndustries;
use frontend\models\Presentations;
use frontend\models\PresentationsSearch;
use frontend\models\PresentationSpecs;
use frontend\models\PresentationSpecModels;
use frontend\models\PresentationMethods;
use frontend\models\PresentationMethodModels;
use frontend\models\PresentationLocations;
use frontend\models\PresentationIssues;
use frontend\models\PresentationImages;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use frontend\models\Activities;
use frontend\models\Offers;
use frontend\models\Log;
use frontend\models\UserLog;
use frontend\models\Notifications;
use frontend\models\Locations;
use dektrium\user\models\User;
use dektrium\user\models\LoginForm;
use dektrium\user\models\RegistrationForm;
use dektrium\user\models\RegistrationProviderForm;
use dektrium\user\traits\AjaxValidationTrait;

/**
 * PresentationsController implements the CRUD actions for Presentations model.
 */
class PresentationsController extends Controller
{
    use AjaxValidationTrait;

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
        $this->layout = '/product';

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
        $this->layout = '/user_presentation';

        if($ps = Yii::$app->request->get('ProviderServices')){
            if($service = $this->findService($ps['service_id'])){ // service
                //print_r($service); die();
                $object_model = !empty($ps['object_model']) ? $this->findObjectModel($ps['object_model']) : null; // object_model
                $user = (!Yii::$app->user->isGuest) ? \frontend\models\User::findOne(Yii::$app->user->id) : null; // presenter
                $model = new Presentations(); // new presentation
                $model->service = $service;                
                $model_methods = $this->loadPresentationMethods($service); // array of new presentationMethods
                $model_specs = $this->loadPresentationSpecifications($service, $object_model); // array of new presentationSpecs
                $location = new Locations(); // new location
                $location->control = $service->location;
                $location->userControl = (Yii::$app->user->isGuest) ? 0 : 1;
                $new_provider = ($user==null) ? Yii::createObject(RegistrationProviderForm::className()) : null;  // register provider
                $returning_user = ($user==null) ? Yii::createObject(LoginForm::className()) : null; // login existing user
                if($user==null){
                    $this->performAjaxValidation($new_provider);
                    $this->performAjaxValidation($returning_user);
                } 
                if ($model->load(Yii::$app->request->post())) {
                    $checkPresenter = $user==null ? 1 : null; // check if new user
                    if($user = $user==null ? $this->saveUser($new_provider, $returning_user) : $user){ // load user(presenter)
                        if($user->is_provider==0){
                            if(!$this->saveProvider($user, $service)){
                                return $this->goBack();
                            }
                        }
                        if($proserv = $ps['id']==null ? $this->saveProviderService($user, $service) : $this->findProviderService($ps['id'])){
                            if($this->savePresentation($model, $user, $service, $object_model, $location, $proserv, $checkPresenter, $model_specs, $model_methods)){
                                
                                return $checkPresenter!=null ? $this->redirect(['/blank']) : $this->redirect(['/presentation/'.$model->id]);
                            }   
                        }                         
                    } else {
                        return $this->goBack();
                    }                    
                } else {
                    return $this->render('create', [
                        'service' => $service,
                        'model' => $model,
                        'model_methods' => $model_methods,
                        'model_specs' => $model_specs,
                        'object_model' => $object_model,
                        'new_provider' => $new_provider,
                        'returning_user' => $returning_user,
                        'location'=> $location,
                        'user' => $user,
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
        $this->layout = '/user_presentation';

        $model = $this->findModel($id);
        $model->service = $model->pService;
        $user = $model->user;
        $location = $model->locations[0]->location;
        if($model_methods = $model->methods){
            $this->loadPresentationMethodsUpdate($model_methods, $model);
        }            
        if($model_specs = $model->specs){
            $this->loadPresentationSpecificationsUpdate($model_specs, $model);
        }
        if ($model->load(Yii::$app->request->post()) && $this->updatePresentation($model, $user, $location, $model_specs, $model_methods)) {
            return $this->redirect(['/presentation/'.$model->id]);
        } else {
            return $this->render('update', [
                'service' => $model->pService,
                'model' => $model,
                'model_methods' => $model_methods,
                'model_specs' => $model_specs,
                'object_model' => $model->objectModel,
                'new_provider' => null,
                'returning_user' => null,
                'location'=> $location,
                'user' => $user,
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

    /**
     * Finds the Presentations model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $id
     * @return Presentations the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findProviderService($id)
    {
        if (($model = \frontend\models\ProviderServices::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    protected function checkUserObjectsExist($service, $object_model)
    {
        if(!Yii::$app->user->isGuest && $object_model){
            $user = \frontend\models\User::findOne(Yii::$app->user->id);
            if($user->userObjects){
                foreach ($user->userObjects as $userObject){
                    if($userObject->object_id==$service->object_id || $userObject->object_id==$object_model->id){
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

    /**
     * Izlistava sve specifikacije izabranih predmeta usluga i modela predmeta.
     */
    protected function objectSpecifications($service, $object_model)
    {
        if($object_model!=null || $service->serviceSpecs!=null) {
            if($service->serviceSpecs!=null){
               foreach($service->serviceSpecs as $serviceSpec) {
                    if($serviceSpec->spec) {
                        $objectSpecification[] = $serviceSpec->spec;
                    }           
                } 
            }
            if($object_model!=null){                
                $object = \frontend\models\CsObjects::findOne($object_model->id);
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

    /**
     * Kreira Modele PresentationSpecs za sve izabrane specifikacije.
     */
    protected function loadPresentationSpecifications($service, $object_model)
    {
        if($objectSpecs = $this->objectSpecifications($service, $object_model)){
            foreach($objectSpecs as $objectSpec) {
                if($objectSpec->property) {
                    $property = $objectSpec->property;
                    $model_spec[$property->id] = new PresentationSpecs();
                    $model_spec[$property->id]->specification = $objectSpec;
                    $model_spec[$property->id]->property = $property;
                    $model_spec[$property->id]->service = $service;
                    $model_spec[$property->id]->checkUserObject = ($this->checkUserObjectsExist($service, $object_model)) ? 0 : 1;
                }                                   
            }
            return (isset($model_spec)) ? $model_spec : null;
        }
        return null;        
    }

    /**
     * Kreira Modele PresentationSpecs za sve izabrane specifikacije.
     */
    protected function loadPresentationSpecificationsUpdate($model_specs, $model)
    {
        if($model_specs && $model){
            foreach($model_specs as $model_spec){
                $property = $model_spec->spec->property;
                $model_spec->specification = $model_spec->spec;
                $model_spec->property = $property;
                $model_spec->service = $model->pService;
                $model_spec->checkUserObject = ($this->checkUserObjectsExist($model->pService, $model->objectModel)) ? 0 : 1;
            }
            return $model_specs;
        }
        return null;        
    }

    protected function loadPresentationMethods($service)
    {
        if($service->serviceMethods!=null) {
            foreach($service->serviceMethods as $serviceMethod) {
                if($serviceMethod->method) {
                    if($property = $serviceMethod->method->property) { 
                        $model_methods[$property->id] = new \frontend\models\PresentationMethods();
                        $model_methods[$property->id]->serviceMethod = $serviceMethod->method;
                        $model_methods[$property->id]->property = $property;
                        $model_methods[$property->id]->service = $service;
                    }
                }           
            }
            return (isset($model_methods)) ? $model_methods : null;
        }
        return null;
    }

    protected function loadPresentationMethodsUpdate($model_methods, $model)
    {
        if($model_methods && $model) {
            foreach($model_methods as $model_method){
                $property = $model_method->method->property;
                $model_method->serviceMethod = $model_method->method;
                $model_method->property = $property;
                $model_method->service = $model->pService;
            }
            return $model_methods;
        }
        return null;
    }

    protected function saveProviderService($user=null, $service=null)
    {
        if($user && $service) {
            $proserv = new ProviderServices();
            $proserv->provider_industry_id = $user->provider->industries[0]->id;
            $proserv->provider_id = $user->provider->id;
            $proserv->industry_id = $service->industry_id;
            $proserv->service_id = $service->id;
            $proserv->is_set = 1;
            $proserv->update_time = date('Y-m-d H:i:s');
            if($proserv->save(false)){
                return $proserv;
            }
            return false;
        }
        return false;
    }

    protected function saveProvider($user=null, $service=null)
    {
        if($user && $service) {
            $provider = new \frontend\models\Provider();
            $provider->user_id = $user->id;
            $provider->industry_id = $service->industry_id;
            $provider->registration_time = date('Y-m-d H:i:s');
            if($provider->save()){
                // provider Industry
                $providerIndustry = new \frontend\models\ProviderIndustries();
                $providerIndustry->provider_id = $provider->id;
                $providerIndustry->industry_id = $service->industry_id;
                $providerIndustry->main = 1;
                $providerIndustry->save();
                // provider Language
                $providerLanguage = new \frontend\models\ProviderLanguages();
                $providerLanguage->provider_id = $provider->id;
                $providerLanguage->lang_code = 'SR';
                $providerLanguage->save();
                // provider Locations
                $providerLocation = new \frontend\models\ProviderLocations();
                $providerLocation->provider_id = $provider->id;
                $providerLocation->loc_id = $user->details->loc_id;
                $providerLocation->name = 'Primarna lokacija';
                $providerLocation->save();
                // provider Portfolio
                $providerPortfolio = new \frontend\models\ProviderPortfolio();
                $providerPortfolio->provider_id = $provider->id;
                $providerPortfolio->name = 'Moj portfolio';
                $providerPortfolio->save();
                // provider Terms
                $providerTerms = new \frontend\models\ProviderTerms();
                $providerTerms->provider_id = $provider->id;
                $providerTerms->update_time = date('Y-m-d H:i:s');
                $providerTerms->save();

                return true;
            }
        }
        return false;
    }

    protected function saveUser($new_provider, $returning_user)
    {
        if ($new_provider->load(Yii::$app->request->post())) {                         
            if ($dektuser = $new_provider->register()) {
                $user = \frontend\models\User::findOne($dektuser->id);
            }
        }
        if ($returning_user->load(Yii::$app->getRequest()->post()) && $returning_user->login()) {
            $user = \frontend\models\User::findOne(Yii::$app->user->id);
        }

        if($user != null){
            return $user;
        }
        return false;
    }

    protected function savePresentation($model, $user, $service, $object_model, $location, $proserv, $checkPresenter, $model_specs, $model_methods)
    {
        if($model && $user && $service && $object_model && $proserv) {            
            $activity = Activities::loadActivity($user->id, 'presentation');
            if($activity->save()){
                $offer = Offers::loadOffer($activity->id);
                if($offer->save()){
                    $model->activity_id = $activity->id;
                    $model->offer_id = $offer->id;
                    $model->provider_service_id = $proserv->id;
                    $model->provider_id = $proserv->provider_id;
                    $model->service_id = $service->id;
                    $model->object_id = $service->object->id;
                    $model->object_model_id = $object_model->id;     
                    $model->imageFiles = UploadedFile::getInstances($model, 'imageFiles');               
                    // location
                    // 1 ako je register, onda nova lokacija, iz registracije $model->loc_id = $user->details->loc_id;
                    // 2 ako je izabrao samo, onda loc_id $model->load(...)
                    // 3 ako je nova lokacija onda location $model->loc_id = $location->id;
                    if($checkPresenter==null){
                        if($location->load(Yii::$app->request->post())){ // 3
                            $location->user_id = $user->id;
                            if($location->save()){
                                $model->loc_id = $location->id;
                            } else {
                                return false;
                            }
                        }
                    } else { // 1 ako je register
                        $model->loc_id = $user->details->loc_id;
                    }
                    $model->status = $checkPresenter ? 'pending' : 'active';
                    if($model->save()){
                        // Presentation Specs
                        if(Model::loadMultiple($model_specs, Yii::$app->request->post())) {
                            foreach ($model_specs as $m_spec) {
                                //if($m_spec->value!=null || $m_spec['spec_models']!=null){
                                $m_spec->presentation_id = $model->id;
                                if($m_spec->save()){
                                    if($m_spec['spec_models']!=null){                                            
                                        foreach($m_spec['spec_models'] as $key=>$spec_model){
                                            $new_spec_model[$key] = new PresentationSpecModels();
                                            $new_spec_model[$key]->presentation_spec_id = $m_spec->id;
                                            $new_spec_model[$key]->spec_model = $spec_model;
                                            $new_spec_model[$key]->save();
                                        }
                                    }
                                }                                        
                                //}                                
                            }
                        }                        
                        // Presentation Methods
                        if(Model::loadMultiple($model_methods, Yii::$app->request->post())) {
                            foreach ($model_methods as $m_method) {
                                //if($m_method->value!=null || $m_method['method_models']!=null){
                                $m_method->presentation_id = $model->id;
                                if($m_method->save()){
                                    if($m_method['method_models']!=null){
                                        foreach($m_method['method_models'] as $key=>$method_model){
                                            $new_method_model[$key] = new PresentationMethodModels();
                                            $new_method_model[$key]->presentation_method_id = $m_method->id;
                                            $new_method_model[$key]->method_model = $method_model;
                                            $new_method_model[$key]->save();
                                        }
                                    }
                                }                                        
                                //}                                
                            }
                        }                        
                        // Presentation Images
                        if ($model->imageFiles) {
                            $model->upload();
                        }                        
                        // Presentation Issues
                        /*$model_issues = new PresentationIssues(); */
                        // Presentation Locations
                        $model_locations = new PresentationLocations();
                        $model_locations->presentation_id = $model->id;
                        $model_locations->location_id = $model->loc_id;
                        $model_locations->location_within = $model->loc_within;
                        $model_locations->save();

                        return true; 
                    }
                }
            }
        }
        return false;
    }


    protected function updatePresentation($model, $user, $location, $model_specs, $model_methods)
    {
        if($model && $user) {            
            $activity = $model->activity;
            $activity->update_time = date('Y-m-d H:i:s');
            if($activity->save()){
                $offer = $model->offer;
                $offer->update_time = date('Y-m-d H:i:s');
                if($offer->save()){
                    $model->imageFiles = UploadedFile::getInstances($model, 'imageFiles');               
                    // location
                    // 1 ako je register, onda nova lokacija, iz registracije $model->loc_id = $user->details->loc_id;
                    // 2 ako je izabrao samo, onda loc_id $model->load(...)
                    // 3 ako je nova lokacija onda location $model->loc_id = $location->id;
                    /*if($checkPresenter==null){
                        if($location->load(Yii::$app->request->post())){ // 3
                            $location->user_id = $user->id;
                            if($location->save()){
                                $model->loc_id = $location->id;
                            } else {
                                return false;
                            }
                        }
                    } else { // 1 ako je register
                        $model->loc_id = $user->details->loc_id;
                    }*/
                    if($model->save()){
                        // Presentation Specs
                        if(Model::loadMultiple($model_specs, Yii::$app->request->post())) {
                            foreach ($model_specs as $m_spec) {
                                if($m_spec->save()){
                                    /*if($m_spec['spec_models']!=null){                                            
                                        foreach($m_spec['spec_models'] as $key=>$spec_model){
                                            $new_spec_model[$key] = new PresentationSpecModels();
                                            $new_spec_model[$key]->presentation_spec_id = $m_spec->id;
                                            $new_spec_model[$key]->spec_model = $spec_model;
                                            $new_spec_model[$key]->save();
                                        }
                                    }*/
                                }                                        
                                //}                                
                            }
                        }                        
                        // Presentation Methods
                        if(Model::loadMultiple($model_methods, Yii::$app->request->post())) {
                            foreach ($model_methods as $m_method) {
                                //if($m_method->value!=null || $m_method['method_models']!=null){
                                $m_method->presentation_id = $model->id;
                                if($m_method->save()){
                                    /*if($m_method['method_models']!=null){
                                        foreach($m_method['method_models'] as $key=>$method_model){
                                            $new_method_model[$key] = new PresentationMethodModels();
                                            $new_method_model[$key]->presentation_method_id = $m_method->id;
                                            $new_method_model[$key]->method_model = $method_model;
                                            $new_method_model[$key]->save();
                                        }
                                    }*/
                                }                                        
                                //}                                
                            }
                        }                        
                        // Presentation Images
                        if ($model->imageFiles) {
                            $model->upload();
                        }                        
                        // Presentation Issues
                        /*$model_issues = new PresentationIssues(); */
                        // Presentation Locations
                        /*$model_locations = new PresentationLocations();
                        $model_locations->presentation_id = $model->id;
                        $model_locations->location_id = $model->loc_id;
                        $model_locations->location_within = $model->loc_within;
                        $model_locations->save();*/

                        return true; 
                    }
                }
            }
        }
        return false;
    }
}
