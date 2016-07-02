<?php

namespace frontend\controllers;

use Yii;
use common\models\CsServices;
use common\models\CsServicesSearch;
use common\models\CsObjects;
use common\models\CsIndustries;
use common\models\CsActions;
use common\models\CsProducts;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\Request;
use yii\web\Session;
use yii\data\ActiveDataProvider;
use common\models\Activities;
use common\models\Offers;

/**
 * ServicesController implements the CRUD actions for CsServices model.
 */
class ServicesController extends Controller
{
    public $layout='index_service';

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
     * Lists all CsServices models.
     * @return mixed
     */
    public function actionIndex($entity = null, $title = null)
    {
        $request = Yii::$app->request;
        $session = Yii::$app->session;

        //$session->removeAll();
        $entity = $request->get('entity');
        $title = $request->get('title');

        if($state = $request->get('st')){            
            $session->set('state', $state);
            if($state=='gl'){
                $session->remove('state');
            }
        }
        $q = $request->get('q');
        $queryObjects = ($q) ?  new ActiveDataProvider([
                    'query' => CsObjects::find()->joinWith(['t t'])->where(['like', 't.name', $q])->andWhere('cs_objects.class != "abstract"')->groupBy('cs_objects.id'),
                ]) : null;
        $queryIndustries = ($q) ? new ActiveDataProvider([
                    'query' => CsIndustries::find()->joinWith(['t t'])->where(['like', 't.name', $q])->groupBy('cs_industries.id'),
                ]) : null;
        //$queryIndustries = ($q) ? $this->suggested_word($q) : null;
        $queryActions = ($q) ? new ActiveDataProvider([
                    'query' => CsActions::find()->joinWith(['t t'])->where(['like', 't.name', $q])->groupBy('cs_actions.id'),
                ]) : null;
        $queryProducts = ($q) ? new ActiveDataProvider([
                    'query' => CsProducts::find()->where(['like', 'name', $q])->andWhere(['or', 'level=1', 'level=2']),
                ]) : null;

        $object = ($entity=='o' and $title) ? $this->findObjectByTitle($title) : null;
        $industry = ($entity=='i' and $title) ? $this->findIndustryByTitle($title) : null;
        $action = ($entity=='a' and $title) ? $this->findActionByTitle($title) : null;
        $product = ($entity=='p' and $title) ? $this->findProductByTitle($title) : null;

        $renderIndex = $object || $industry || $action || $product || $q ? false : true;
        
        $searchModel = new CsServicesSearch();
        $dataProvider = $searchModel->search(['CsServicesSearch'=>['name'=>$q, 'industry_id'=>$industry ? $industry->id : null, 'action_id'=>$action ? $action->id : null, 'object_id'=>$object ? $object->id : null,]]);

        
        return $this->render('index', [
            //'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'renderIndex' => $renderIndex,
            'industry' => $industry,
            'action' => $action,
            'object' => $object,
            'product' => $product, 
            'searchString' => $request->get('q'),           
            'queryObjects' => $queryObjects,
            'queryIndustries' => $queryIndustries,
            'queryActions' => $queryActions, 
            'queryProducts' => $queryProducts, 
            'countSearchResults' => $this->countSearchResults($dataProvider, $queryObjects, $queryIndustries, $queryActions, $queryProducts),
            'countServicesResults' => $this->countServicesResults($dataProvider),
            'countIndustriesResults' => $this->countIndustriesResults($queryIndustries),
            'countActionsResults' => $this->countActionsResults($queryActions),
            'countObjectsResults' => $this->countObjectsResults($queryObjects),
            'countProductsResults' => $this->countProductsResults($queryProducts),
        ]);
    }

    /**
     * Displays a single CsServices model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($title=null)
    {
        $this->layout = '//profile';

        if (isset($title)) {
            $model = $this->findModelByTitle($title);            

            return $this->render('view', [
                'model' => $model,
            ]);
                   
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }        
    }

    /**
     * Lists all CsServices models.
     * @return mixed
     */
    public function actionAdd()
    {
        $searchModel = new CsServicesSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('add', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Finds the CsServices model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return CsServices the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = CsServices::findOne($id)) !== null) {
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
        if (($model_tr = \common\models\CsServicesTranslation::find()->where('name=:name and lang_code="SR"', [':name'=>str_replace('-', ' ', $title)])->one()) !== null) {
            // ako je našao ime usluge, renderuj stranicu - URL injection
            if ($model_tr and $model = $this->findModel($model_tr->service_id)) { 
                return $model;
            } else {
                throw new NotFoundHttpException('The requested page does not exist.');
            }
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
    protected function findObjectByTitle($title)
    {
        if (($model = \common\models\CsObjectsTranslation::find()->where('name=:name and lang_code="SR"', [':name'=>str_replace('-', ' ', $title)])->one()) !== null) {
            return $model->object;
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
    protected function findActionByTitle($title)
    {
        if (($model = \common\models\CsActionsTranslation::find()->where('name=:name and lang_code="SR"', [':name'=>str_replace('-', ' ', $title)])->one()) !== null) {
            return $model->action;
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
    protected function findIndustryByTitle($title)
    {
        if (($model = \common\models\CsIndustriesTranslation::find()->where('name=:name and lang_code="SR"', [':name'=>str_replace('-', ' ', $title)])->one()) !== null) {
            return $model->industry;
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
    protected function findProductByTitle($title)
    {
        if (($model = \common\models\CsProducts::find()->where('name=:name', [':name'=>str_replace('-', ' ', $title)])->one()) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    /**
     * Lists all ProviderServices models.
     * @return mixed
     */
    /*public function actionObjectModelsPresent($id=null)
    {
        if($id){
            if($service = $this->findModel($id)) {
                return $this->renderAjax('//services/_object_models-present', [
                    'model' => $service,
                    'object' => $service->object,
                ]);
            }
        }
        return;            
    }*/

    /**
     * Lists all ProviderServices models.
     * @return mixed
     */
    public function actionPresentationOms($title=null)
    {
        $this->layout = '//basic';

        if (isset($title)) {
            $service = $this->findModelByTitle($title); // a service to be presented
            //$new_presentation = new \common\models\ProviderServices;

            // create draft Presentation
            $model = new \frontend\models\PresentationData;

            if($ps = Yii::$app->request->get('PresentationData')){
                $current_user = (!Yii::$app->user->isGuest) ? \common\models\User::findOne(Yii::$app->user->id) : null; // presenter

                if($current_user == null) {
                    $user = $this->currentUser();
                    Yii::$app->user->login($user, Yii::$app->getModule('user')->rememberFor);
                } else {
                    if($current_user->provider){
                        $user = $this->currentProvider($service);
                    } else {
                        $user = $current_user;
                    }                
                }

                //echo '<pre>';
                //print_r($ps); die();

                if($this->savePresentation($model, $user, $service, $ps['object_models'], $user->provider->initialService)){
                    return $this->redirect(['/presentation-object/'.$model->id]);
                }                
            }
                
            return $this->render('presentation-oms', [
                'service' => $service,
                'object' => $service->object,
                'model' => $model,
            ]);
        }
        return;            
    }

    /**
     * Lists all ProviderServices models.
     * @return mixed
     */
    public function actionObjectModelsOrder($id=null)
    {
        if($id){
            if($service = $this->findModel($id)) {
                return $this->renderAjax('//services/_object_models', [
                    'model' => $service,
                    'object' => $service->object,
                ]);
            }
        }
        return;            
    }

    public function suggested_word($result, &$p = null, &$percent = null) 
    {
        
        $actions = \common\models\CsIndustriesTranslation::find()->all();        
        $data = [];
        foreach ($actions as $key=>$word) {
            $string = explode(' ',$word->name);
            $res_string = explode(' ',$result);
            
            for ($i=0; $i<6; $i++) {
                for ($j=0; $j<6; $j++) {
                    if (!empty($res_string[$i]) && !empty($string[$j])) {
                        $f = similar_text($res_string[$i], $string[$j], $p);

                        $lev = levenshtein($res_string[$i], $string[$j]);
                        $percent = round((1 - $lev / max(strlen($res_string[$i]), strlen($string[$j])))*100, 0);
                        
                        if ((strlen($res_string[$i])==$f) && (strpos($string[$j],$res_string[$i]) !== false)) {
                            $data [] = array($f, $percent, $word->name, round($p,0), $word->id);
                        }

                        if ((strlen($res_string[$i])!=$f) && $p>70 && $percent>50) {
                            $data [] = array($f, $percent, $word->name, round($p,0), $word->id);
                        }  
                    }                   
                }               
            }

            
        } // kraj foreach
        if (!empty($data)) {
                $fs = [];          
                foreach ($data as $row) {
                    $fs[]  = $row[0];
                    $percents[]  = $row[1];
                    $words[]  = $row[2];
                    $ps[]  = $row[3];                              
                }

                array_multisort($fs, SORT_DESC, $percents, SORT_DESC, $data);
                $output = [];

                foreach ($data as $date) 
                {
                    $delatnost = \frontend\models\CsIndustriesTranslation::find($date[4])->one();
                    
                    $ind = $delatnost->industry;
                    //$output .= '<li class="list-group-item" style="height: auto; line-height: 22px; font-size: 16px; font-weight:700; padding:5px 20px;"><span style="font-size: 11px; font-weight:400; color: '.$ind->color.'"><i class="'.$ind->icon.'"></i></span> '.c($ind->tName), Yii::app()->createUrl('site/index', array('del'=>$delatnost->delatnost->id, 'controller'=>'ind', 'page_action'=>'details')), array('style'=>'background: none !important;')).' | <span class="fs_12" style="color:#aaa;">'.$delatnost->delatnost->kat->kategorijeTranslations[0]->ime.'</span><span style="float: right; font-size: 11px; color: #aaa;">('.$date[1].'%)</span></li>'; // treba uaciti action_translations
                    $output[] = $ind;
                } // kraj foreach action
                return $output; 
                
        } else {
            return false;
        }
    }

    public function countSearchResults($dataProvider, $queryObjects, $queryIndustries, $queryActions, $queryProducts) 
    {
        return ($dataProvider ? $dataProvider->totalCount : 0)+($queryIndustries ? $queryIndustries->totalCount : 0)+($queryActions ? $queryActions->totalCount : 0)+($queryObjects ? $queryObjects->totalCount : 0)+($queryProducts ? $queryProducts->totalCount : 0);
    }

    public function countServicesResults($dataProvider) 
    {
        return $dataProvider ? $dataProvider->totalCount : 0;
    }

    public function countIndustriesResults($queryIndustries) 
    {
        return $queryIndustries ? $queryIndustries->totalCount : 0;
    }

    public function countActionsResults($queryActions) 
    {
        return $queryActions ? $queryActions->totalCount : 0;
    }

    public function countObjectsResults($queryObjects) 
    {
        return $queryObjects ? $queryObjects->totalCount : 0;
    }

    public function countProductsResults($queryProducts) 
    {
        return $queryProducts ? $queryProducts->totalCount : 0;
    }


    public function currentUser() 
    {        // create temoporary user
        $t_user = Yii::createObject(RegistrationForm::className());

        return $t_user->temoporary();       
    }

    public function currentProvider($model) 
    { 
        $user = \common\models\User::findOne(Yii::$app->user->id);

        // create temp provider
        $provider = new \common\models\Provider();
        $provider->user_id = $user->id;
        $provider->industry_id = $model->industry_id;
        $provider->loc_id = 1;
        $provider->legal_form = 'freelancer';
        $provider->type = 'service_provider';
        $provider->department_type = 'hq';
        $provider->status = 'inactive';
        $provider->is_active = 0;
        $provider->registration_time = date('Y-m-d H:i:s');
        $provider->save();

        if($provider->save()){
            // provider Industry
            $providerIndustry = new \common\models\ProviderIndustries();
            $providerIndustry->provider_id = $provider->id;
            $providerIndustry->industry_id = $model->industry_id;
            $providerIndustry->main = 1;
            if($providerIndustry->save()) {
                $proserv = new \common\models\ProviderServices();
                $proserv->provider_industry_id = $providerIndustry->id;
                $proserv->provider_id = $provider->id;
                $proserv->industry_id = $model->industry_id;
                $proserv->service_id = $model->id;
                $proserv->is_set = 1;
                $proserv->update_time = date('Y-m-d H:i:s');
                $proserv->save();
            }
            // provider Industry Terms
            $providerIndustryTerm = new \common\models\ProviderIndustryTerms();
            $providerIndustryTerm->provider_industry_id = $providerIndustry->id;
            $providerIndustryTerm->update_time = date('Y-m-d H:i:s');
            $providerIndustryTerm->save();
            // provider Language
            $providerLanguage = new \common\models\ProviderLanguages();
            $providerLanguage->provider_id = $provider->id;
            $providerLanguage->lang_code = 'SR';
            $providerLanguage->save();                                
            // provider Portfolio
            $providerPortfolio = new \common\models\ProviderPortfolio();
            $providerPortfolio->provider_id = $provider->id;
            $providerPortfolio->name = 'Moj portfolio';
            $providerPortfolio->save();
            // provider Terms
            $providerTerms = new \common\models\ProviderTerms();
            $providerTerms->provider_id = $provider->id;
            $providerTerms->update_time = date('Y-m-d H:i:s');
            $providerTerms->save();
            // provider Notifications
            $providerNotifications = new \common\models\ProviderNotifications();
            $providerNotifications->provider_id = $provider->id;
            $providerNotifications->notification_type = 'matching';
            $providerNotifications->time = date('Y-m-d H:i:s');
            $providerNotifications->save();
        }

        return $user;
    }

    protected function savePresentation($model, $user, $service, $object_model, $proserv)
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
                    $model->object_id = $service->object_id;
                    $model->price = 0;
                    $model->loc_id = 1;
                    $model->status = 'draft';  
                    $model->save();

                    if($model->save()){
                        // Presentation Object Models
                        if($object_model){
                            foreach($object_model as $ob_model){
                                $model_object_models = new \common\models\PresentationObjectModels();
                                $model_object_models->presentation_id = $model->id;
                                $model_object_models->object_model_id = $ob_model;
                                $model_object_models->save();
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
}
