<?php

namespace frontend\models;

use Yii;
use yii\web\UploadedFile;
use yii\imagine\Image;
use frontend\models\Activities;
use frontend\models\Offers;

class PresentationData extends Presentations
{
    public function checkIfMethods()
    {
        return ($this->service->serviceActionProperties) ? 0 : 1;
    }

    public function checkIfSpecs()
    {
        return ($this->service->serviceObjectProperties!=null or ($this->service->object->isPart() and $this->service->object->parent and $this->service->object->parent->objectProperties)) ? 0 : 1;
    }

     public function checkIfIssues()
    {
        return ($this->service->service_type==6 && ($this->service->object->issues!=null or (count($this->object_models)==1 and $this->object_models[0]->issues))) ? 0 : 1;
    }

    public function checkIfLocation()
    {
        return ($this->service->location!=0) ? 0 : 1;
    }

    public function checkIfAmount()
    {
        return ($this->service->amount!=0 or $this->service->object_ownership!='provider') ? 0 : 1;
    }

    public function checkIfConsumer()
    {
        return ($this->service->consumer!=0) ? 0 : 1;
    }

    public function checkIfAvailability()
    {
        return ($this->service->availability!=0) ? 0 : 1;
    } 

    public function checkIfUpdate()
    {
        return (Yii::$app->controller->action->id=='update') ? 0 : 1;
    }

    public function getNoPic()
    {
        return 2-$this->checkIfSpecs();
    }

    public function getNoIssues()
    {
        return 3-$this->checkIfSpecs();
    }

    public function getNoMethods()
    {
        return 4-$this->checkIfSpecs()-$this->checkIfIssues();
    }

    public function getNoTitle()
    {
        return 5-$this->checkIfSpecs()-$this->checkIfIssues()-$this->checkIfMethods();
    }

    public function getNoLocation()
    {
        return 6-$this->checkIfSpecs()-$this->checkIfIssues()-$this->checkIfMethods();
    }

    public function getNoPrice()
    {
        return 7-$this->checkIfSpecs()-$this->checkIfIssues()-$this->checkIfMethods()-$this->checkIfLocation();
    }

    public function getNoAmount()
    {
        return 8-$this->checkIfSpecs()-$this->checkIfIssues()-$this->checkIfMethods()-$this->checkIfLocation();
    }

    public function getNoConsumer()
    {
        return 9-$this->checkIfSpecs()-$this->checkIfIssues()-$this->checkIfMethods()-$this->checkIfLocation()-$this->checkIfAmount();
    }    

    public function getNoAvailability()
    {
        return 10-$this->checkIfSpecs()-$this->checkIfIssues()-$this->checkIfMethods()-$this->checkIfLocation()-$this->checkIfAmount()-$this->checkIfConsumer();
    }

    public function getNoValidity()
    {
        return 11-$this->checkIfSpecs()-$this->checkIfIssues()-$this->checkIfMethods()-$this->checkIfLocation()-$this->checkIfAmount()-$this->checkIfConsumer()-$this->checkIfAvailability();
    }

    public function getNoNotifications()
    {
        return 12-$this->checkIfSpecs()-$this->checkIfIssues()-$this->checkIfMethods()-$this->checkIfLocation()-$this->checkIfAmount()-$this->checkIfConsumer()-$this->checkIfAvailability();
    }

    public function getNoTerms()
    {
        return 13-$this->checkIfSpecs()-$this->checkIfIssues()-$this->checkIfMethods()-$this->checkIfLocation()-$this->checkIfAmount()-$this->checkIfConsumer()-$this->checkIfAvailability()-$this->checkIfUpdate();
    }

    /*public function getNoOther()
    {
        return 14-$this->checkIfSpecs()-$this->checkIfIssues()-$this->checkIfMethods()-$this->checkIfLocation()-$this->checkIfAmount()-$this->checkIfConsumer()-$this->checkIfAvailability();
    }*/

    public function getNoUac()
    {
        return 14-$this->checkIfSpecs()-$this->checkIfIssues()-$this->checkIfMethods()-$this->checkIfLocation()-$this->checkIfAmount()-$this->checkIfConsumer()-$this->checkIfAvailability()-$this->checkIfUpdate()-$this->checkIfUpdate();
    }

    public function locationOperatingModels()
    {
        // 0-within
        // 1-HQ
        // 2-City (up to 20km)
        // 3-Region (up to 200)
        // 4-Country (up to 500 km)
        // 5-Wide (up to 1000km)
        // 6-Worldwide
        $service = $this->service;
        $model_list = [];
        if($service){
            switch ($service->coverage) {
            case 0:
                $model_list = [];
                break;
            case 3:
                $model_list = [
                    5=>'<b><span class="loc_op_country"></span></b> i šire', 
                    4=>'Samo u okviru države <b><span class="loc_op_country"></span></b>', 
                    //'region'=>'Samo u okviru regiona <b><span class="loc_op_region"></span></b>', 
                    3=>'Samo u gradu <b><span class="loc_op_city"></span></b>',
                    1=>'Samo u sedištu <b><span class="loc_op_exact"></span></b>',
                    0=>'<span class="loc_op_circle">Odredi područje na mapi</span>',
                ];
                break;
            case 4:
                $model_list = [
                    6=>'Bez ograničenja (ceo svet/nebitno)', 
                    5=>'<b><span class="loc_op_country"></span></b> i šire',
                    4=>'Samo u okviru države <b><span class="loc_op_country"></span></b>', 
                    //'region'=>'Samo u okviru regiona <b><span class="loc_op_region"></span></b>', 
                    2=>'Samo u gradu <b><span class="loc_op_city"></span></b>',
                    1=>'Samo u sedištu <b><span class="loc_op_exact"></span></b>',
                    0=>'<span class="loc_op_circle">Odredi područje na mapi</span>',
                ];
                break;
            default:
                $model_list = [
                    //'region'=>'Samo u okviru regiona <b><span class="loc_op_region"></span></b>', 
                    2=>'Samo u gradu <b><span class="loc_op_city"></span></b>',
                    1=>'Samo u sedištu <b><span class="loc_op_exact"></span></b>',
                    0=>'<span class="loc_op_circle">Odredi područje na mapi</span>',
                ];
            }
        }
        return $model_list;
    }

     public function locationOperatingModelsSearch()
    {
        // 0-within
        // 2-City (up to 20km)
        // 4-Country (up to 500 km)
        // 6-Worldwide
        $service = $this->service;
        $model_list = [];
        if($service){
            switch ($service->coverage) {
            case 0:
                $model_list = [];
                break;
            case 3:
                $model_list = [
                    4=>'Samo u okviru države <b><span class="loc_op_country"></span></b>', 
                    2=>'Samo u gradu <b><span class="loc_op_city"></span></b>',
                    0=>'<span class="loc_op_circle">Odredi područje na mapi</span>',
                ];
                break;
            case 4:
                $model_list = [
                    6=>'Bez ograničenja (ceo svet/nebitno)', 
                    4=>'Samo u okviru države <b><span class="loc_op_country"></span></b>', 
                    2=>'Samo u gradu <b><span class="loc_op_city"></span></b>',
                    0=>'<span class="loc_op_circle">Odredi područje na mapi</span>',
                ];
                break;
            default:
                $model_list = [
                    2=>'Samo u gradu <b><span class="loc_op_city"></span></b>',
                    0=>'<span class="loc_op_circle">Odredi područje na mapi</span>',
                ];
            }
        }
        return $model_list;
    }

    /**
     * Izlistava sve specifikacije izabranih predmeta usluga i modela predmeta.
     */
    public function allObjectProperties($service, $object_model=null)
    {
        //$object_model = $this->objectModels;
        //$service = $this->pService;
        if($object_model!=null or $service->serviceObjectProperties!=null) {
            if($serviceObjectProperties = $service->serviceObjectProperties){
               foreach($serviceObjectProperties as $serviceObjectProperty) {
                    if($objectProperty = $serviceObjectProperty->objectProperty) {
                        $objectProperties[] = $objectProperty;
                    }           
                } 
            }
            if($service->object->isPart() && $parentObjectProperties = $service->object->parent->objectProperties){
               foreach($parentObjectProperties as $parentObjectProperty) {
                    if($parentObjectProperty) {
                        $objectProperties[] = $parentObjectProperty;
                    }           
                } 
            }
            if($object_model!=null && count($object_model)==1){
                if ($objectSpecs = $object_model[0]->objectProperties) {
                    foreach($objectSpecs as $objectSpec) {
                        if(!in_array($objectSpec, $objectProperties)){ 
                            $objectProperties[] = $objectSpec;                               
                        }                                   
                    }
                }           
            }          
        } 
        return (isset($objectProperties)) ? $objectProperties : null;
    }

    public function checkUserObjectsExist($service, $object_model)
    {
        if(!Yii::$app->user->isGuest && $object_model && count($object_model)==1){
            $user = \frontend\models\User::findOne(Yii::$app->user->id);
            if($user->userObjects){
                foreach ($user->userObjects as $userObject){
                    if($userObject->object_id==$service->object_id or $userObject->object_id==$object_model[0]->id){
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
     * Kreira Modele PresentationSpecs za sve izabrane specifikacije.
     */
    public function loadPresentationObjectProperties($service, $object_model)
    {
        if($objectProperties = $this->allObjectProperties($service, $object_model)){
            foreach($objectProperties as $objectProperty) {
                if($property = $objectProperty->property) {
                    $model_object_properties[$property->id] = new PresentationObjectProperties();
                    $model_object_properties[$property->id]->theObjectProperty = $objectProperty;
                    $model_object_properties[$property->id]->property = $property;
                    $model_object_properties[$property->id]->service = $service;
                    $model_object_properties[$property->id]->checkUserObject = ($this->checkUserObjectsExist($service, $object_model)) ? 0 : 1;
                }                                   
            }
            return (isset($model_object_properties)) ? $model_object_properties : null;
        }
        return null;        
    }

    /**
     * Kreira Modele PresentationSpecs za sve izabrane specifikacije.
     */
    public function loadPresentationObjectPropertiesUpdate($model_object_properties)
    {
        if($model_object_properties){
            foreach($model_object_properties as $model_object_property){
                $property = $model_object_property->objectProperty->property;
                $model_object_property->objectProperty = $model_object_property->objectProperty;
                $model_object_property->property = $property;
                $model_object_property->service = $this->pService;
                $model_object_property->checkUserObject = ($this->checkUserObjectsExist($this->pService, $this->objectModels)) ? 0 : 1;
            }
            return $model_object_properties;
        }
        return null;        
    }

    /**
     * Kreira Modele PresentationSpecs za sve izabrane specifikacije.
     */
    public function loadPresentationSpecificationsIndex($model_object_properties)
    {
        if($model_object_properties){
            foreach($model_object_properties as $key=>$model_object_property){
                $property = \frontend\models\CsProperties::findOne($key);
                $model_object_property->theObjectProperty = $model_object_property->objectProperty;
                $model_object_property->property = $property;
                $model_object_property->service = $this->pService;
                $model_object_property->checkUserObject = ($this->checkUserObjectsExist($this->pService, $this->objectModels)) ? 0 : 1;
            }
            return $model_object_properties;
        }
        return null;         
    }

    public function loadPresentationActionProperties($service)
    {
        if($serviceActionProperties = $service->serviceActionProperties) {
            foreach($serviceActionProperties as $serviceActionProperty) {
                if($actionProperty = $serviceActionProperty->actionProperty) {
                    if($property = $actionProperty->property) { 
                        $model_action_properties[$property->id] = new \frontend\models\PresentationActionProperties();
                        $model_action_properties[$property->id]->theActionProperty = $actionProperty;
                        $model_action_properties[$property->id]->property = $property;
                        $model_action_properties[$property->id]->service = $service;
                    }
                }           
            }
            return (isset($model_action_properties)) ? $model_action_properties : null;
        }
        return null;
    }

    public function loadPresentationActionPropertiesUpdate($model_action_properties)
    {
        if($model_action_properties) {
            foreach($model_action_properties as $model_action_property){
                $property = $model_action_property->actionProperty->property;
                $model_action_property->actionProperty = $model_action_property->actionProperty;
                $model_action_property->property = $property;
                $model_action_property->service = $this->pService;
            }
            return $model_action_properties;
        }
        return null;
    }

    public function generatePricePerUnit()
    {
        $pricePer['total'] = 'ukupno';
        if($units = $this->service->units){
            foreach ($units as $key => $unit) {
                $pricePer[$unit->unit->id] = '/'.$unit->unit->oznaka;
            }
        }
        return $pricePer;
    }
}
