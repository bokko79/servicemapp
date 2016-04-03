<?php

namespace frontend\controllers;

use Yii;
use yii\base\Model;
use yii\web\UploadedFile;
use frontend\models\ProviderServices;
use frontend\models\ProviderIndustries;
use frontend\models\Presentations;
use frontend\models\PresentationData;
use frontend\models\PresentationsSearch;
use frontend\models\PresentationSpecs;
use frontend\models\PresentationSpecModels;
use frontend\models\PresentationMethods;
use frontend\models\PresentationMethodModels;
use frontend\models\PresentationObjectModels;
use frontend\models\PresentationLocations;
use frontend\models\PresentationIssues;
use frontend\models\PresentationImages;
use frontend\models\PresentationTimetables;
use frontend\models\PresentationNotifications;
use frontend\models\PresentationTerms;
use frontend\models\PresentationTermMilestones;
use frontend\models\PresentationTermExpenses;
use frontend\models\PresentationTermClauses;
use frontend\models\ProviderOpeningHours;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use frontend\models\Activities;
use frontend\models\Offers;
use frontend\models\Log;
use frontend\models\UserLog;
use frontend\models\Notifications;
use frontend\models\Locations;
use frontend\models\LocationPresentation;
use frontend\models\LocationPresentationTo;
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
        $service = (Yii::$app->request->get('PresentationsSearch') and isset(Yii::$app->request->get('PresentationsSearch')['service_id'])) ? $this->findService(Yii::$app->request->get('PresentationsSearch')['service_id']) : null;

        $this->layout = '/index_presentation';

        $searchModel = new PresentationsSearch();
        $searchModel->service = $service;
        $model_specs = $searchModel->loadPresentationSpecifications($service, null);
        $model_methods = $searchModel->loadPresentationMethods($service);
        $location = (Yii::$app->user->location) ? Yii::$app->user->location : new \frontend\models\Locations();
        //print_r(Yii::$app->request->queryParams); die();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'service' => $service,
            'model_specs' => $model_specs,
            'model_methods' => $model_methods,
            'location' => $location,
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
                $object_model = [];
                if(!empty($ps['object_model'])){
                    foreach ($ps['object_model'] as $pso){
                        $object_model[] = $this->findObjectModel($pso);
                    }
                }
                $user = (!Yii::$app->user->isGuest) ? \frontend\models\User::findOne(Yii::$app->user->id) : null; // presenter
                $model = new PresentationData(); // new presentation
                $model->service = $service; 
                $model->object_models = $object_model; 
                $model->location_control = $service->location;
                $model->location_userControl = (Yii::$app->user->isGuest) ? 0 : 1;
                $model_methods = $model->loadPresentationMethods($service); // array of new presentationMethods
                $model_specs = $model->loadPresentationSpecifications($service, $object_model); // array of new presentationSpecs          
                $locationHQ = $model->hasProviderLocation() ? $model->hasProviderLocation() : new Locations();           
                $locationPresentation = new LocationPresentation();
                $locationPresentationTo = new LocationPresentationTo();
                $model_timetable = new PresentationTimetables();
                $provider_openingHours = ($user and $provider = $user->provider and $provider->openingHours) ? $provider->openingHours : new ProviderOpeningHours();
                $model_notifications = new PresentationNotifications();
                $model_terms = new PresentationTerms();
                $model_termexpenses = new PresentationTermExpenses();
                $model_termmilestones = new PresentationTermMilestones();
                $model_termclauses = new PresentationTermClauses();
                $new_provider = ($user==null) ? Yii::createObject(RegistrationProviderForm::className()) : null;  // register provider
                $new_provider->scenario = 'presentation';
                $returning_user = ($user==null) ? Yii::createObject(LoginForm::className()) : null; // login existing user
                $returning_user->scenario = 'presentation';
                if($user==null){
                    $this->performAjaxValidation($new_provider);
                    $this->performAjaxValidation($returning_user);
                } 
                if ($model->load(Yii::$app->request->post())) {
                    $newUser = $user==null ? true : false; // check if new user                    
                    if($user = $user==null ? $this->saveUser($new_provider, $returning_user) : $user){ // load user(presenter)
                        if($newProvider = $user->is_provider==0 ? true : false){
                            if($proserv = $this->saveProvider($user, $service)){
                                if($this->savePresentation($model, $user, $service, $object_model, $locationHQ, $locationPresentation, $locationPresentationTo, $proserv, $newUser, $newProvider, $model_specs, $model_methods, $model_terms, $model_timetable, $model_notifications, $provider_openingHours, $model_termexpenses, $model_termmilestones, $model_termclauses)){                                
                                    return $this->redirect(['/presentation/'.$model->id]);
                                }
                            }
                        }
                        if($proserv = $ps['id']==null ? $this->saveProviderService($user, $service, $newProvider) : $this->findProviderService($ps['id'])){
                            if($this->savePresentation($model, $user, $service, $object_model, $locationHQ, $locationPresentation, $locationPresentationTo, $proserv, $newUser, $newProvider, $model_specs, $model_methods, $model_terms, $model_timetable, $model_notifications, $provider_openingHours, $model_termexpenses, $model_termmilestones, $model_termclauses)){                                
                                return $newUser ? $this->redirect(['/blank']) : $this->redirect(['/presentation/'.$model->id]);
                            }
                        }                     
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
                        'locationHQ'=> $locationHQ,
                        'locationPresentation'=> $locationPresentation,
                        'locationPresentationTo'=> $locationPresentationTo,
                        'user' => $user,
                        'model_timetable' => $model_timetable,
                        'provider_openingHours' => $provider_openingHours,
                        'model_notifications' => $model_notifications,
                        'model_terms' => $model_terms,
                        'model_termexpenses' => $model_termexpenses,
                        'model_termmilestones' => $model_termmilestones,
                        'model_termclauses' => $model_termclauses,
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
        $user = $model->user;
        if(!Yii::$app->user->isGuest and Yii::$app->user->id==$user->id){

            $this->layout = '/user_presentation';

            $model->service = $model->pService;
            $service = $model->pService;
            $model->location_control = $service->location;
            $model->location_userControl = 1;
            
            $object_model = $model->objectModels;
            $locationHQ = $user->provider->location;
            $locationPresentation = $model->location;
            $model->location_from = ($locationPresentation) ? $locationPresentation->location_name : null;
            $locationPresentationTo = $model->locationTo;
            $model->location_to = ($locationPresentationTo) ? $locationPresentationTo->location_name : null;
            $model_timetable = $model->timetables;
            $provider_openingHours = $user->provider->openingHours;
            $model_notifications = $model->notifications;
            $model_terms = $model->terms;
            if($model_methods = $model->methods){
                $model->loadPresentationMethodsUpdate($model_methods);
            }            
            if($model_specs = $model->specs){
                $model->loadPresentationSpecificationsUpdate($model_specs);
            }
            if ($model->load(Yii::$app->request->post()) && $this->updatePresentation($model, $user, $service, $object_model, $locationHQ, $locationPresentation, $locationPresentationTo, $model_specs, $model_methods, $model_terms, $model_timetable, $model_notifications, $provider_openingHours)) {
                return $this->redirect(['/presentation/'.$model->id]);
                //return $this->redirect(Yii::$app->request->referrer);
            } else {
                return $this->render('update', [
                    'service' => $service,
                    'model' => $model,
                    'model_methods' => $model_methods,
                    'model_specs' => $model_specs,
                    'object_model' => $object_model,
                    'locationHQ'=> $locationHQ,
                    'locationPresentation'=> $locationPresentation,
                    'locationPresentationTo'=> $locationPresentationTo,
                    'user' => $user,
                    'model_timetable' => $model_timetable,
                    'provider_openingHours' => $provider_openingHours,
                    'model_notifications' => $model_notifications,
                    'model_terms' => $model_terms,
                    'new_provider' => null,
                    'returning_user' => null,
                    'model_termexpenses' => null,
                    'model_termmilestones' => null,
                    'model_termclauses' => null,
                ]);
            }
        } else {
            return $this->redirect('/market');
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
        if (($model = PresentationData::findOne($id)) !== null) {
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

    /**
     * Finds the Presentations model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $id
     * @return Presentations the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findPresentationImages($id)
    {
        if (($model = \frontend\models\PresentationImages::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }       

    protected function saveProviderService($user=null, $service=null, $newProvider)
    {        
        if($user and $service) {            
            if(!$newProvider and $user->provider and $prs = ProviderServices::find()->where('provider_id='.$user->provider->id.' AND service_id='.$service->id)->all()){
                return $prs[0];
            } else {
                $proserv = new \frontend\models\ProviderServices();
                $proserv->provider_industry_id = $user->provider->industries[0]->id;
                $proserv->provider_id = $user->provider->id;
                $proserv->industry_id = $service->industry_id;
                $proserv->service_id = $service->id;
                $proserv->is_set = 1;
                $proserv->update_time = date('Y-m-d H:i:s');
                if($proserv->save()){
                    return $proserv;
                }
                return false;
            }           
        }
        return false;
    }

    protected function saveProvider($user=null, $service=null)
    {
        if($user and $service) {
            $provider = new \frontend\models\Provider();
            $provider->user_id = $user->id;
            $provider->industry_id = $service->industry_id;
            $provider->loc_id = $user->details->loc_id;
            $provider->legal_form = 'freelancer';
            $provider->type = 'service_provider';
            $provider->department_type = 'hq';
            $provider->status = 'active';
            $provider->registration_time = date('Y-m-d H:i:s');
            if($provider->save()){ 
                $user->is_provider = 1;
                $user->save();               
                // provider Contact
                $providerContact = new \frontend\models\ProviderContact();
                $providerContact->provider_id = $provider->id;
                $providerContact->contact_type = 'e-mail';
                $providerContact->value = $user->email;
                $providerContact->save();
                // provider Industry
                $providerIndustry = new \frontend\models\ProviderIndustries();
                $providerIndustry->provider_id = $provider->id;
                $providerIndustry->industry_id = $service->industry_id;
                $providerIndustry->main = 1;
                if($providerIndustry->save()){
                    $proserv = new \frontend\models\ProviderServices();
                    $proserv->provider_industry_id = $providerIndustry->id;
                    $proserv->provider_id = $provider->id;
                    $proserv->industry_id = $service->industry_id;
                    $proserv->service_id = $service->id;
                    $proserv->is_set = 1;
                    $proserv->update_time = date('Y-m-d H:i:s');
                    $proserv->save();
                }
                // provider Industry Terms
                $providerIndustryTerm = new \frontend\models\ProviderIndustryTerms();
                $providerIndustryTerm->provider_industry_id = $providerIndustry->id;
                $providerIndustryTerm->update_time = date('Y-m-d H:i:s');
                $providerIndustryTerm->save();
                // provider Language
                $providerLanguage = new \frontend\models\ProviderLanguages();
                $providerLanguage->provider_id = $provider->id;
                $providerLanguage->lang_code = 'SR';
                $providerLanguage->save();
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
                // provider Notifications
                $providerNotifications = new \frontend\models\ProviderNotifications();
                $providerNotifications->provider_id = $provider->id;
                $providerNotifications->notification_type = 'matching';
                $providerNotifications->time = date('Y-m-d H:i:s');
                $providerNotifications->save();

                return $proserv;
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

        if($user!=null){
            return $user;
        }
        return false;
    }

    protected function savePresentation($model, $user, $service, $object_model, $locationHQ, $locationPresentation, $locationPresentationTo, $proserv, $newUser, $newProvider, $model_specs, $model_methods, $model_terms, $model_timetable, $model_notifications, $provider_openingHours, $model_termexpenses, $model_termmilestones, $model_termclauses)
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
                    $model->price_unit = ($model->price_unit=='total') ? $service->unit_id : $model->price_unit;
                    //$model->object_model_id = ($object_model && count($object_model)==1) ? $object_model[0]->id : null;     
                    $model->imageFiles = UploadedFile::getInstances($model, 'imageFiles');
                    //$model->files = UploadedFile::getInstances($model, 'files');
                    $model->status = $newUser ? 'pending' : 'active';               
                    // location HQ
                    if($locationHQ->load(Yii::$app->request->post()) and !$newUser and !$newProvider){
                        if($locationHQ && !$locationHQ->save()){
                            return false;
                        }
                    }
                    // location FROM
                    if($locationPresentation->load(Yii::$app->request->post())){
                        $locationPresentation->user_id = $user->id;
                        if($locationPresentation->save()){
                            $model->loc_id = $locationPresentation->id;
                        }                              
                    } else {
                        $model->loc_id = $proserv->provider->loc_id;
                    }
                    // location TO
                    if($locationPresentationTo->load(Yii::$app->request->post())){
                        $locationPresentationTo->user_id = $user->id;
                        if($locationPresentationTo->save()){
                            $model->loc_to_id = $locationPresentationTo->id;
                        }                              
                    }
                    
                    $model->coverage = $model->coverage!=null ? $model->coverage : $proserv->provider->coverage;
                    $model->coverage_within = $model->coverage_within!=null ? $model->coverage_within : $proserv->provider->coverage_within;
                    //print_r($model); die();
                    if($model->save()){
                        // Presentation Object Models
                        if($object_model){
                            foreach($object_model as $ob_model){
                                $model_object_models = new PresentationObjectModels();
                                $model_object_models->presentation_id = $model->id;
                                $model_object_models->object_model_id = $ob_model->id;
                                $model_object_models->save();
                            }
                        }
                        // Presentation Specs
                        if($model_specs){
                            if($model->provider_presentation_specs && $model->provider_presentation_specs!=''){
                                $existPres = $this->findModel($model->provider_presentation_specs);
                                if($existPresSpecs = $existPres->specs){
                                    foreach ($existPresSpecs as $existPresSpec) {                                        
                                        $mod_spec = new PresentationSpecs();
                                        $mod_spec->presentation_id = $model->id;
                                        $mod_spec->spec_id = $existPresSpec->spec_id;
                                        $mod_spec->value = $existPresSpec->value;
                                        $mod_spec->value_max = $existPresSpec->value_max;
                                        $mod_spec->value_operator = $existPresSpec->value_operator;
                                        $mod_spec->multiple_values = $existPresSpec->multiple_values;
                                        $mod_spec->read_only = $existPresSpec->read_only;
                                        $mod_spec->save();
                                        
                                        if($existPresSpecModels = $existPresSpec->models){                                        
                                            foreach($existPresSpecModels as $key=>$existPresSpecModel){
                                                $new_spec_model[$key] = new PresentationSpecModels();
                                                $new_spec_model[$key]->presentation_spec_id = $mod_spec->id;
                                                $new_spec_model[$key]->spec_model = $existPresSpecModel->spec_model;
                                                $new_spec_model[$key]->save();
                                            }
                                        }                                 
                                    }
                                }
                            } else {
                                if(Model::loadMultiple($model_specs, Yii::$app->request->post())) {
                                    foreach ($model_specs as $m_spec) {
                                        $m_spec->presentation_id = $model->id;
                                        $m_spec->multiple_values = ($m_spec['spec_models']!=null) ? 1 : 0;
                                        if($m_spec->save()){
                                            if($m_spec['spec_models']!=null){                                                    
                                                if(is_array($m_spec['spec_models'])){                                            
                                                    foreach($m_spec['spec_models'] as $key=>$spec_model){
                                                        $new_spec_model[$key] = new PresentationSpecModels();
                                                        $new_spec_model[$key]->presentation_spec_id = $m_spec->id;
                                                        $new_spec_model[$key]->spec_model = $spec_model;
                                                        $new_spec_model[$key]->save();
                                                    }
                                                } else {
                                                    $new_spec_model = new PresentationSpecModels();
                                                    $new_spec_model->presentation_spec_id = $m_spec->id;
                                                    $new_spec_model->spec_model = $m_spec['spec_models'];
                                                    $new_spec_model->save();
                                                }
                                            }
                                        }                               
                                    }
                                } 
                            } 
                        }                                
                        // Presentation Images             
                        if($model->provider_presentation_pics && $model->provider_presentation_pics!=''){
                            $existPres = $this->findModel($model->provider_presentation_pics);
                            if($existPresImages = $existPres->images){
                                foreach($existPresImages as $existPresImage){
                                    $new_image = new PresentationImages();
                                    $new_image->presentation_id = $model->id;
                                    $new_image->image_id = $existPresImage->image_id;
                                    $new_image->save();
                                }
                            }
                        } else {
                            if ($model->imageFiles) {
                                $model->upload();
                            }
                        }                                                
                        // Presentation Issues
                        if($model->issues){
                            foreach($model->issues as $issue){
                                $model_issue = new PresentationIssues();
                                $model_issue->presentation_id = $model->id;
                                $model_issue->issue = $issue;
                                $model_issue->save();
                            }
                        }
                        // Presentation Methods
                        if($model_methods){
                            if($model->provider_presentation_methods && $model->provider_presentation_methods!=''){                            
                                $existPres = $this->findModel($model->provider_presentation_methods);
                                if($existPresMethods = $existPres->methods){
                                    foreach ($existPresMethods as $existPresMethod) {                                        
                                        $mod_meth = new PresentationMethods();
                                        $mod_meth->presentation_id = $model->id;
                                        $mod_meth->method_id = $existPresMethod->method_id;
                                        $mod_meth->value = $existPresMethod->value;
                                        $mod_meth->value_max = $existPresMethod->value_max;
                                        $mod_meth->value_operator = $existPresMethod->value_operator;
                                        $mod_meth->multiple_values = $existPresMethod->multiple_values;
                                        $mod_meth->read_only = $existPresMethod->read_only;
                                        $mod_meth->save();                                        
                                        if($existPresMethodModels = $existPresMethod->models){                                        
                                            foreach($existPresMethodModels as $key=>$existPresMethodModel){
                                                $new_meth_model[$key] = new PresentationMethodModels();
                                                $new_meth_model[$key]->presentation_method_id = $mod_meth->id;
                                                $new_meth_model[$key]->method_model = $existPresMethodModel->method_model;
                                                $new_meth_model[$key]->save();
                                            }
                                        }                                 
                                    }
                                }
                            } else {
                                if(Model::loadMultiple($model_methods, Yii::$app->request->post())) {
                                    foreach ($model_methods as $m_method) {
                                        $m_method->presentation_id = $model->id;
                                        $m_method->multiple_values = ($m_method['method_models']!=null) ? 1 : 0;
                                        if($m_method->save()){
                                            if($m_method['method_models']!=null){                                                    
                                                if(is_array($m_method['method_models'])){
                                                    foreach($m_method['method_models'] as $key=>$method_model){
                                                        $new_method_model[$key] = new PresentationMethodModels();
                                                        $new_method_model[$key]->presentation_method_id = $m_method->id;
                                                        $new_method_model[$key]->method_model = $method_model;
                                                        $new_method_model[$key]->save();
                                                    }
                                                } else {
                                                    $new_method_model = new PresentationMethodModels();
                                                    $new_method_model->presentation_method_id = $m_method->id;
                                                    $new_method_model->method_model = $m_method['method_models'];
                                                    $new_method_model->save();
                                                }
                                            }
                                        }                                  
                                    }
                                }
                            } 
                        }
                        // Presentation Notifications
                        $model_notifications->presentation_id = $model->id;
                        $model_notifications->time = date('Y-m-d H:i:s');
                        $model_notifications->save();
                        // Presentation Terms
                        $model_terms->presentation_id = $model->id;
                        $model_terms->update_time = date('Y-m-d H:i:s');
                        $model_terms->save();                                
                        // Presentation Timetables
                        if($model_timetable->load(Yii::$app->request->post()) && $model_timetable->validate()){
                            $model_timetable->presentation_id = $model->id;
                            $model_notifications->save();
                        }
                        // Provider OpeningHours
                        $poh = Yii::$app->request->post('ProviderOpeningHours');
                        if($poh!=null){
                            foreach ($poh['day_of_week'] as $key=>$value) {
                                $provider_openingHour[$key] = new ProviderOpeningHours();
                                $provider_openingHour[$key]->provider_id = $proserv->provider_id;
                                $provider_openingHour[$key]->workingDay = $poh['workingDay'][$key];
                                $provider_openingHour[$key]->open = $poh['open'][$key];
                                $provider_openingHour[$key]->closed = $poh['closed'][$key];
                                $provider_openingHour[$key]->day_of_week = $poh['day_of_week'][$key];
                                $provider_openingHour[$key]->save();
                            }
                        }

                        return true; 
                    } else {
                        echo '<pre>';
                        print_r($model); die();
                    }
                }
            }
        }
        return false;
    }


    protected function updatePresentation($model, $user, $service, $object_model, $locationHQ, $locationPresentation, $locationPresentationTo, $model_specs, $model_methods, $model_terms, $model_timetable, $model_notifications, $provider_openingHours)
    {
        if($model && $user) {            
            $activity = $model->activity;
            $activity->update_time = date('Y-m-d H:i:s');
            if($activity->save()){
                $offer = $model->offer;
                $offer->update_time = date('Y-m-d H:i:s');
                if($offer->save()){
                    $model->imageFiles = UploadedFile::getInstances($model, 'imageFiles');
                    $model->price_unit = ($model->price_per=='total') ? $service->unit_id : $model->price_unit;
                    // location HQ
                    if($locationHQ and $locationHQ->load(Yii::$app->request->post())){
                        if($locationHQ && !$locationHQ->save()){
                            echo '<pre>';
                            print_r($locationHQ); die();
                        }           
                    }
                    // location FROM
                    if($locationPresentation and $locationPresentation->load(Yii::$app->request->post())){
                        if(!$locationPresentation->save()){
                            echo '<pre>';
                            print_r($locationPresentation); die();
                        }                               
                    }
                    // location TO
                    if($locationPresentationTo and $locationPresentationTo->load(Yii::$app->request->post())){
                        if(!$locationPresentationTo->save()){
                            echo '<pre>';
                            print_r($locationPresentationTo); die();
                        }                              
                    } 
                    if($model->save()){
                        // Presentation Specs
                        if(Model::loadMultiple($model_specs, Yii::$app->request->post())) {
                            foreach ($model_specs as $m_spec) {                                
                                if($m_spec->save()){
                                    if($m_spec['spec_models']!=null){
                                        if(is_array($m_spec['spec_models'])){
                                            // get all existing models
                                            $mspec_models = []; // contains all the ids
                                            foreach($m_spec->models as $pres_spec_model){
                                                $mspec_models[] = $pres_spec_model->spec_model;
                                                if(!in_array($pres_spec_model->spec_model, $m_spec['spec_models'])){
                                                    $pres_spec_model->delete();
                                                }
                                            }                                            
                                            foreach($m_spec['spec_models'] as $key=>$spec_model){
                                                if(!in_array($spec_model, $mspec_models)){
                                                    $new_spec_model[$key] = new PresentationSpecModels();
                                                    $new_spec_model[$key]->presentation_spec_id = $m_spec->id;
                                                    $new_spec_model[$key]->spec_model = $spec_model;
                                                    $new_spec_model[$key]->save();
                                                }                                            
                                            }
                                        } else {
                                            $mode = $m_spec->models[0];
                                            $mode->spec_model = $m_spec['spec_models'];
                                            $mode->save();
                                        }
                                    } else {
                                        $part = $m_spec->property->formTypePresentation($service->service_object);
                                        if($part=='_multiselect' or $part=='_checkboxButton'){
                                            foreach($m_spec->models as $pres_spec_model){
                                                $pres_spec_model->delete();
                                            }
                                        }
                                    }
                                }                                 
                            }
                        }                                                
                        // Presentation Images
                        if ($model->imageFiles) {
                            $model->upload();
                        }                        
                        // Presentation Issues
                        // Presentation Issues
                        if($model->issues){
                            foreach($model->issues as $issue){
                                $model_issue = new PresentationIssues();
                                $model_issue->presentation_id = $model->id;
                                $model_issue->issue = $issue;
                                $model_issue->save();
                            }
                        }
                        // Presentation Methods
                        if(Model::loadMultiple($model_methods, Yii::$app->request->post())) {
                            foreach ($model_methods as $m_method) {
                                //$m_method->presentation_id = $model->id;
                                if($m_method->save()){
                                    if($m_method['method_models']!=null){
                                        if(is_array($m_method['method_models'])){
                                            // get all existing models
                                            $mmethod_models = []; // contains all the ids
                                            foreach($m_method->models as $pres_method_model){
                                                $mmethod_models[] = $pres_method_model->method_model;
                                                if(!in_array($pres_method_model->method_model, $m_method['method_models'])){
                                                    $pres_method_model->delete();
                                                }
                                            } 
                                            foreach($m_method['method_models'] as $key=>$method_model){
                                                if(!in_array($method_model, $mmethod_models)){
                                                    $new_method_model[$key] = new PresentationMethodModels();
                                                    $new_method_model[$key]->presentation_method_id = $m_method->id;
                                                    $new_method_model[$key]->method_model = $method_model;
                                                    $new_method_model[$key]->save();
                                                }
                                            }
                                        } else {
                                            $mode = $m_method->models[0];
                                            $mode->method_model = $m_method['method_models'];
                                            $mode->save();
                                        }                                            
                                    } else {
                                        $part = $m_spec->property->formTypePresentation($service->service_object);
                                        if($part=='_multiselect' or $part=='_checkboxButton'){
                                            foreach($m_method->models as $pres_method_model){
                                                $pres_method_model->delete();
                                            }
                                        }
                                    }
                                }
                            }
                        }
                        // Presentation Notifications
                        if($model_notifications->load(Yii::$app->request->post()) && $model_notifications->validate()){
                            $model_notifications->time = date('Y-m-d H:i:s');
                            $model_notifications->save();
                        }
                        // Presentation Terms                        
                        if($model_terms->load(Yii::$app->request->post()) && $model_terms->validate()){
                            $model_terms->update_time = date('Y-m-d H:i:s');
                            if(!$model_terms->save()){
                                /*if($model_termexpenses->load(Yii::$app->request->post()) && $model_termexpenses->validate()){
                                    $model_termexpenses->presentation_term_id = $model_terms->presentation_id;
                                    $model_termexpenses->save();
                                }
                                if($model_termmilestones->load(Yii::$app->request->post()) && $model_termmilestones->validate()){
                                    $model_termmilestones->presentation_term_id = $model_terms->presentation_id;
                                    $model_termmilestones->save();
                                }
                                if($model_termclauses->load(Yii::$app->request->post()) && $model_termclauses->validate()){
                                    $model_termclauses->presentation_term_id = $model_terms->presentation_id;
                                    $model_termclauses->save();
                                }*/
                                return false;
                            }                                
                        }

                        return true; 
                    }
                }
            }
        }
        return false;
    }

    /**
     * Lists all ProviderServices models.
     * @return mixed
     */
    public function actionShowThemSpecs($id=null)
    {
        if($id){
            if($presentation = $this->findModel($id)) {
                return $this->renderPartial('//presentations/_specs', [
                    'model' => $presentation,
                    'specs' => $presentation->specs,
                ]);
            }
        }
        return;            
    }

    /**
     * Lists all ProviderServices models.
     * @return mixed
     */
    public function actionShowThemPics($id=null)
    {
        if($id){
            if($presentation = $this->findModel($id)) {
                return $this->renderPartial('//presentations/_images', [
                    'model' => $presentation,
                    'medias' => $presentation->images,
                ]);
            }
        }
        return;            
    }

    /**
     * Lists all ProviderServices models.
     * @return mixed
     */
    public function actionShowThemMethods($id=null)
    {
        if($id){
            if($presentation = $this->findModel($id)) {
                return $this->renderPartial('//presentations/_methods', [
                    'model' => $presentation,
                    'methods' => $presentation->methods,
                ]);
            }
        }
        return;            
    }

    /**
     * Deletes a photo/pdf.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param string $id
     * @return mixed
     */
    public function actionDeleteFile($id)
    {
        $pimage = $this->findPresentationImages($id);
        $red = $pimage->presentation->id;
        if($pimage){
            $file = $pimage->image;
            $pimage->delete();
            if($file->type=='pdf'){
                $file->delete();
                unlink(Yii::getAlias('@webroot/images/presentations/docs/'.$pimage->image->ime));
            } else { // slika
                $file->delete();
                unlink(Yii::getAlias('@webroot/images/presentations/thumbs/'.$pimage->image->ime));
                unlink(Yii::getAlias('@webroot/images/presentations/full/'.$pimage->image->ime));
                unlink(Yii::getAlias('@webroot/images/presentations/'.$pimage->image->ime));
            } 

            return $this->redirect('/presentation-setup/'.$red);
        }            
        return false;        
    }
}
