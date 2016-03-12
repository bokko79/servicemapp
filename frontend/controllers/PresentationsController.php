<?php

namespace frontend\controllers;

use Yii;
use frontend\models\ProviderServices;
use frontend\models\ProviderIndustries;
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
        if($ps = Yii::$app->request->get('ProviderServices')){
            $service = $this->findService($ps['service_id']);
            if($service){
                $object_model = !empty($ps['object_model']) ? $this->findObjectModel($ps['object_model']) : null;
                $user = (!Yii::$app->user->isGuest) ? \frontend\models\User::findOne(Yii::$app->user->id) : null;
                $model = new Presentations();
                $model->service = $service;
                $model_methods = $this->loadPresentationMethods($service);
                $model_specs = $this->loadPresentationSpecifications($service, $object_model);
                $location = new Locations();
                $location->control = $service->location;
                $location->userControl = (Yii::$app->user->isGuest) ? 0 : 1;
                $notification = new Notifications();
                $log = new Log();
                $user_log = new UserLog();
                $new_provider = Yii::createObject(RegistrationProviderForm::className());                
                $this->performAjaxValidation($new_provider);
                $returning_user = Yii::createObject(LoginForm::className());
                $this->performAjaxValidation($returning_user);
                
                if ($model->load(Yii::$app->request->post())) {
                    // check if new user
                    $checkPresenter = null;
                    if($user==null){
                        // save provider
                        if ($new_provider->load(Yii::$app->request->post())) {                         
                            if ($dektuser = $new_provider->register()) {
                                $user = \frontend\models\User::findOne($dektuser->id);
                                $checkPresenter = 1;
                            }
                        }
                        if ($returning_user->load(Yii::$app->getRequest()->post()) && $returning_user->login()) {
                            $user = \frontend\models\User::findOne(Yii::$app->user->id);
                            $checkPresenter = 2;
                        }
                    }
                    if($user){
                        if($user->is_provider==0){
                            if(!$this->saveProvider($user, $service)){
                                return $this->goBack();
                            }
                        }
                        $proserv = ($ps['id']==null) ? $this->saveProviderService($user, $service) : $this->findProviderService($ps['id']);
                        if($proserv){
                            $activity = Activities::loadActivity($user->id, 'presentation');
                            if($activity->save()){
                                $offer = Offers::loadOffer($activity->id);
                                if($offer->save()){
                                    if($this->savePresentation($model, $activity, $offer, $service, $proserv, $checkPresenter)){
                                        return $checkPresenter ? $this->redirect(['/blank']) : $this->redirect(['/presentation/'.$model->id]);
                                    }                                                                                   
                                }
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
                    $model_spec[$property->id] = new \frontend\models\PresentationSpecs();
                    $model_spec[$property->id]->specification = $objectSpec;
                    $model_spec[$property->id]->property = $property;
                    $model_spec[$property->id]->service = $service;
                    $model_spec[$property->id]->checkUserObject = ($this->checkUserObjectsExist($service, $object_model)) ? 0 : 1;
                    $model_spec[$property->id]->checkIfRequired = ($objectSpec->required==1) ? 1 : 0;             
                }                                   
            }
            return (isset($model_spec)) ? $model_spec : null;
        }
        return null;        
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

    protected function savePresentation($model, $activity, $offer, $service, $proserv, $checkPresenter)
    {
        if($user && $service) {
            $model->activity_id = $activity->id;
            $model->offer_id = $offer->id;
            $model->provider_service_id = $proserv->id;
            $model->provider_id = $proserv->provider_id;
            $model->service_id = $service->id;
            $model->object_id = $service->object->id;
            $model->status = $checkPresenter ? 'pending' : 'active';
            if($model->save()){
                // redirect na info
                $model_specs = new PresentationSpecs();
                $model_spec_models = new PresentationSpecModels();
                $model_methods = $this->loadPresentationMethods($service);
                $model_images = new PresentationImages();
                $model_issues = new PresentationIssues();
                $model_locations = new PresentationLocations();
               return true; 
            }
        }
        return false;
    }
}
