<?php

namespace frontend\controllers;

use Yii;
use frontend\models\CsServices;
use frontend\models\CsServicesSearch;
use frontend\models\CsServicesTranslation;
use yii\web\Request;
use yii\web\Session;

class AutocompleteController extends \yii\web\Controller
{
    public $lang_code = 'SR';
    public function actionListActServices()
    {
        return $this->render('list-act-services');
    }

    public function actionListIndActions()
    {
        return $this->render('list-ind-actions');
    }

    public function actionListServices($q = null, $id = null)
    {        
        $query = new \yii\db\Query;
         $query->select('ser.id as id, ind_trans.name AS industry, sec.color AS color, sec.icon AS icon, ser.name AS name')
            ->from('cs_industries AS ind')
            ->innerJoin('cs_industries_translation AS ind_trans', 'ind_trans.industry_id=ind.id')
            ->innerJoin('cs_services AS ser', 'ser.industry_id=ind.id')
            ->innerJoin('cs_services_translation AS ser_trans', 'ser.id=ser_trans.service_id')
            ->innerJoin('cs_categories AS cat', 'cat.id=ind.category_id')
            ->innerJoin('cs_sectors AS sec', 'sec.id=cat.sector_id')
            //->where(['like', 'ind.name', $q])
            ->where(['like', 'ser_trans.name', $q])
            ->andWhere(['ind_trans.lang_code' => $this->lang_code, 'ser_trans.lang_code' => $this->lang_code])
            ->groupBy('ser.id')
            ->orderBy(['ser_trans.name' => SORT_ASC]);
        $command = $query->createCommand();
        $data = $command->queryAll();
        $out = [];
        foreach ($data as $d) {
            $out[] = ['id' => $d['id'], 'name' => $d['name'], 'industry' => $d['industry'], 'icon' => $d['icon'], 'color' => $d['color']];
        }
        echo \yii\helpers\Json::encode($out);
    }

    // THE CONTROLLER
    public function actionListIndustries($q = null, $id = null) {        
        $query = new \yii\db\Query;
        $query->select('ind.id AS industry_id, ind_trans.name AS industry, cat_trans.name AS category, sec.color AS color, sec.icon AS icon,')
            ->from('cs_industries AS ind')
            ->innerJoin('cs_industries_translation AS ind_trans', 'ind_trans.industry_id=ind.id')
            ->innerJoin('cs_categories AS cat', 'cat.id=ind.category_id')
            ->innerJoin('cs_categories_translation AS cat_trans', 'cat_trans.category_id=cat.id')
            ->innerJoin('cs_sectors AS sec', 'sec.id=cat.sector_id')
            ->where(['like', 'ind.name', $q])
            ->andWhere(['ind_trans.lang_code' => $this->lang_code, 'cat_trans.lang_code' => $this->lang_code])
            ->groupBy('ind.id')
            ->orderBy(['ind_trans.name' => SORT_ASC]);
        $command = $query->createCommand();
        $data = $command->queryAll();
        $out = [];
        foreach ($data as $d) {
            $out[] = ['industry_id' => $d['industry_id'], 'name' => $d['industry'], 'category' => $d['category'], 'icon' => $d['icon'], 'color' => $d['color']];
        }
        echo \yii\helpers\Json::encode($out);
    }

    // THE CONTROLLER
    public function actionListActions($q = null, $id = null) {        
        $query = new \yii\db\Query;
        $query->select('act.id AS action_id, act_trans.name AS action')
            ->from('cs_actions AS act')
            ->innerJoin('cs_actions_translation AS act_trans', 'act_trans.action_id=act.id')
            ->where(['like', 'act_trans.name', $q])
            ->andWhere(['act_trans.lang_code' => $this->lang_code])
            ->groupBy('act.id')
            ->orderBy(['act_trans.name' => SORT_ASC]);
        $command = $query->createCommand();
        $data = $command->queryAll();
        $out = [];
        foreach ($data as $d) {
            $out[] = ['action_id' => $d['action_id'], 'name' => $d['action']];
        }
        echo \yii\helpers\Json::encode($out);
    }

    // THE CONTROLLER
    public function actionListObjects($q = null, $id = null) {        
        $query = new \yii\db\Query;
        $query->select('obj.id AS object_id, obj_trans.name AS object, obj_trans_m.name AS model')
            ->from('cs_objects AS obj')
            ->innerJoin('cs_objects_translation AS obj_trans', 'obj_trans.object_id=obj.id')
            ->innerJoin('cs_objects AS obj_m', 'obj_m.object_id=obj.id')
            ->innerJoin('cs_objects_translation AS obj_trans_m', 'obj_trans_m.object_id=obj_m.id')
            ->where(['like', 'obj_trans.name', $q])
            ->andWhere(['obj_trans.lang_code' => $this->lang_code])
            ->groupBy('obj.id')
            ->orderBy(['obj_trans.name' => SORT_ASC]);
        $command = $query->createCommand();
        $data = $command->queryAll();
        $out = [];
        foreach ($data as $d) {
            $out[] = ['object_id' => $d['object_id'], 'parent' => $d['object'], 'name' => $d['model']];
        }
        echo \yii\helpers\Json::encode($out);
    }

    // THE CONTROLLER
    public function actionListTags($q = null, $id = null) {        
        $query = new \yii\db\Query;
        $query->select('tag.id AS tag_id, tag.tag AS tag')
            ->from('cs_tags AS tag')
            ->where(['like', 'tag.tag', $q])
            ->groupBy('tag.id')
            ->orderBy(['tag.tag' => SORT_ASC]);
        $command = $query->createCommand();
        $data = $command->queryAll();
        $out = [];
        foreach ($data as $d) {
            $out[] = ['tag_id' => $d['tag_id'], 'name' => $d['tag']];
        }
        echo \yii\helpers\Json::encode($out);
    }

    /**
     * Lists all CsServices models.
     * @return mixed
     */
    public function actionIndex()
    {
        $request = Yii::$app->request;

        $post = $request->post('CsServicesSearch');
        $searchModel = new CsServicesSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        // industry
        if(isset($post['industry_id']) && $post['industry_id']!=null && $post['industry_id']!=''){
            $industry = \frontend\models\CsIndustries::findOne($post['industry_id']);
            return $this->redirect(['/services', 'i'=>$industry->id]);
        }
        // object
        if(isset($post['object_id']) && $post['object_id']!=null && $post['object_id']!=''){
            $object = \frontend\models\CsObjects::findOne($post['object_id']);
            return $this->redirect(['/services', 'o'=>$object->id]);
        }
        // action
        if(isset($post['action_id']) && $post['action_id']!=null && $post['action_id']!=''){
            $action = \frontend\models\CsActions::findOne($post['action_id']);
            return $this->redirect(['/services', 'a'=>$action->id]);
        }
        // service
        if(isset($post['id']) && $post['id']!=null && $post['id']!=''){
            $service = \frontend\models\CsServices::findOne($post['id']);
            return $this->redirect(['/s/'.slug($service->tName)]);
        }
        // tags
        if(isset($post['tag']) && $post['tag']!=null && $post['tag']!=''){
            $tag = \frontend\models\CsTags::findOne($post['tag']);
            return $this->redirect(['/services', 'a'=>$tag->entity_id]);
        }
    }

}
