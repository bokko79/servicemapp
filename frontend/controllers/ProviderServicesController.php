<?php

namespace frontend\controllers;

use Yii;
use frontend\models\ProviderIndustries;
use frontend\models\ProviderIndustriesSearch;
use frontend\models\ProviderServices;
use frontend\models\ProviderServicesSearch;
use frontend\models\ProviderIndustrySkills;
use frontend\models\ProviderTerms;
use frontend\models\User;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\base\Model;

/**
 * ProviderServicesController implements the CRUD actions for ProviderServices model.
 */
class ProviderServicesController extends Controller
{
    public $layout='settings';
    
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
     * Lists all ProviderServices models.
     * @return mixed
     */
    public function actionIndex($username=null)
    {
        $this->layout = '/provider_services';

        if (isset($username)) {
            $user = User::find()->where(['username'=>$username])->one();
        }

        if($user && $user->id==Yii::$app->user->id) {
            $searchModel = new ProviderIndustriesSearch();
            $searchModel->provider_id = $user->provider->id;
            $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

            if(Yii::$app->request->post('ProviderIndustries', []) && $this->saveIndustry($user->provider)){
                return $this->redirect('services');
            }

            if(Yii::$app->request->post('ProviderIndustrySkills', []) && $this->saveSkills()){
                return $this->redirect('services');
            } 

            if(Yii::$app->request->post('ProviderServices', []) && $this->saveServices()){
                return $this->redirect('services');
            }

            return $this->render('index', [
                'searchModel' => $searchModel,
                'dataProvider' => $dataProvider,
                'user' => $user,
            ]);
        } else {
            $this->redirect(Yii::$app->request->baseUrl.'/providers');
        }
    }

    /**
     * Lists all ProviderServices models.
     * @return mixed
     */
    public function actionIndustries()
    {
        if($user = User::findOne(Yii::$app->user->id)) {
            return $this->renderPartial('industries', [
                'user' => $user,
            ]);
        } else {
            return;
        }
    }

    /**
     * Displays a single ProviderServices model.
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
     * Creates a new ProviderServices model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new ProviderServices();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing ProviderServices model.
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
     * Deletes an existing ProviderServices model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param string $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(Yii::$app->request->referrer);
    }

    /**
     * Finds the ProviderServices model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $id
     * @return ProviderServices the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = ProviderServices::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    protected function saveIndustry($provider=null)
    {
        if(Yii::$app->request->post('ProviderIndustries', [])){
            $proIndInput = Yii::$app->request->post('ProviderIndustries', []);
            if($proIndInput && !empty($proIndInput['selection'])) {
               foreach($proIndInput['selection'] as $key=>$proind) {
                    $goAhead = false;
                    if($provider->industries){
                        foreach($provider->industries as $providers_Industry){
                            if($providers_Industry->industry_id!=$proind){
                                $goAhead = true;
                                break;
                            }
                        }
                    } 
                    if($goAhead) {
                        $proinds[$key] = new ProviderIndustries();
                        $proinds[$key]->provider_id = $provider->id;
                        $proinds[$key]->industry_id = $proind;
                        $proinds[$key]->main = 0;
                        $proinds[$key]->save(false);
                    }                                                                     
                } 
            } else {
                return false;
            }
            return true;    
        }
        return false;
    }

    protected function saveSkills()
    {
        if(Yii::$app->request->post('ProviderIndustrySkills', [])){
            $proIndSkillInput = Yii::$app->request->post('ProviderIndustrySkills', []);
            $providerIndustry = $this->findIndustry($proIndSkillInput['provider_industry_id']);            
            if(!empty($proIndSkillInput['selection'])){
                // insert
                foreach($proIndSkillInput['selection'] as $key=>$proindSkill) {
                    $goAhead = false;                
                    if($providerIndustry && $providerIndustry->skills){
                        $a = [];
                        foreach($providerIndustry->skills as $providers_Industry_skill){
                            $a[] = $providers_Industry_skill->property_model_id;                            
                        }
                        if(!in_array($proindSkill, $a)){
                            $goAhead = true; 
                        }
                    } else {
                       $goAhead = true; 
                    }
                    if($goAhead) {
                        $proindskill[$key] = new ProviderIndustrySkills();
                        $proindskill[$key]->provider_industry_id = $proIndSkillInput['provider_industry_id'];
                        $proindskill[$key]->skill_id = $proIndSkillInput['skill_id'];
                        $proindskill[$key]->property_model_id = $proindSkill;
                        if(!$proindskill[$key]->save()){
                            return false;
                        }
                    }                                                                     
                }                
            }
            // delete
            if($providerIndustry && $providerIndustry->skills){                
                foreach($providerIndustry->skills as $providers_Industry_skill){
                    $goDel = true;
                    if(!empty($proIndSkillInput['selection'])){
                        foreach($proIndSkillInput['selection'] as $proindSkill) {
                            if($providers_Industry_skill->property_model_id==$proindSkill){
                                $goDel = false;
                                break;
                            }
                        }
                    }
                    if($goDel){
                        $providers_Industry_skill->delete();
                    }

                }   
            }
            return true; 
        }
        return false;
    }

    protected function saveServices()
    {
        if(Yii::$app->request->post('ProviderServices', [])){
            $proServiceInput = Yii::$app->request->post('ProviderServices', []);
            if($proServiceInput){
                $providerIndustry = $this->findIndustry($proServiceInput['provider_industry_id']);
                $a = [];
                if($providerIndustry && $providerIndustry->services){
                    foreach($providerIndustry->services as $providers_service){
                        $a[] = $providers_service->service_id;
                    }
                }
                if(!empty($proServiceInput['selection'])) {
                    foreach($proServiceInput['selection'] as $key=>$proser) {
                        if(!in_array($proser, $a)) {
                            $proserv[$key] = new ProviderServices();
                            $proserv[$key]->provider_industry_id = $proServiceInput['provider_industry_id'];
                            $proserv[$key]->provider_id = $proServiceInput['provider_id'];
                            $proserv[$key]->industry_id = $proServiceInput['industry_id'];
                            $proserv[$key]->service_id = $proser;
                            $proserv[$key]->is_set = 0;
                            $proserv[$key]->update_time = date('Y-m-d H:i:s');
                            $proserv[$key]->save(false); 
                        }                                                                     
                    } 
                } else {
                    return false;
                }
            } else {
                return false;
            }                           
            return true;
        }
        return false;
    }

    /**
     * Finds the ProviderServices model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $id
     * @return ProviderServices the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findIndustry($id)
    {
        if (($model = ProviderIndustries::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    /**
     * Finds the ProviderServices model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $id
     * @return ProviderServices the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findService($id)
    {
        if (($model = ProviderService::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
