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
        return ($this->service->serviceMethods) ? 0 : 1;
    }

    public function checkIfSpecs()
    {
        return ($this->service->serviceSpecs!=null or ($this->service->object->isPart() && $this->service->object->parent->specs)) ? 0 : 1;
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
        return ($this->service->amount!=0 or $this->service->service_object!=1) ? 0 : 1;
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
    public function allObjectSpecifications($service, $object_model=null)
    {
        //$object_model = $this->objectModels;
        //$service = $this->pService;
        if($object_model!=null || $service->serviceSpecs!=null) {
            if($service->serviceSpecs!=null){
               foreach($service->serviceSpecs as $serviceSpec) {
                    if($serviceSpec->spec) {
                        $objectSpecification[] = $serviceSpec->spec;
                    }           
                } 
            }
            if($service->object->isPart() && $service->object->parent->specs){
               foreach($this->service->object->parent->specs as $parentSpec) {
                    if($parentSpec) {
                        $objectSpecification[] = $parentSpec;
                    }           
                } 
            }
            if($object_model!=null && count($object_model)==1){
                if ($objectSpecs = $object_model[0]->specs) {
                    foreach($objectSpecs as $objectSpec) {
                        if(!in_array($objectSpec, $objectSpecification)){ 
                            $objectSpecification[] = $objectSpec;                               
                        }                                   
                    }
                }           
            }          
        } 
        return (isset($objectSpecification)) ? $objectSpecification : null;
    }

    public function checkUserObjectsExist($service, $object_model)
    {
        if(!Yii::$app->user->isGuest && $object_model && count($object_model)==1){
            $user = \frontend\models\User::findOne(Yii::$app->user->id);
            if($user->userObjects){
                foreach ($user->userObjects as $userObject){
                    if($userObject->object_id==$service->object_id || $userObject->object_id==$object_model[0]->id){
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
    public function loadPresentationSpecifications($service, $object_model)
    {
        if($objectSpecs = $this->allObjectSpecifications($service, $object_model)){
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
    public function loadPresentationSpecificationsUpdate($model_specs)
    {
        if($model_specs){
            foreach($model_specs as $model_spec){
                $property = $model_spec->spec->property;
                $model_spec->specification = $model_spec->spec;
                $model_spec->property = $property;
                $model_spec->service = $this->pService;
                $model_spec->checkUserObject = ($this->checkUserObjectsExist($this->pService, $this->objectModels)) ? 0 : 1;
            }
            return $model_specs;
        }
        return null;        
    }

    /**
     * Kreira Modele PresentationSpecs za sve izabrane specifikacije.
     */
    public function loadPresentationSpecificationsIndex($model_specs)
    {
        if($model_specs){
            foreach($model_specs as $key=>$model_spec){
                $property = \frontend\models\CsProperties::findOne($key);
                $model_spec->specification = $model_spec->spec;
                $model_spec->property = $property;
                $model_spec->service = $this->pService;
                $model_spec->checkUserObject = ($this->checkUserObjectsExist($this->pService, $this->objectModels)) ? 0 : 1;
            }
            return $model_specs;
        }
        return null;         
    }

    public function loadPresentationMethods($service)
    {
        if($service->serviceMethods!=null) {
            foreach($service->serviceMethods as $serviceMethod) {
                if($csMethod = $serviceMethod->method) {
                    if($property = $csMethod->property) { 
                        $model_methods[$property->id] = new \frontend\models\PresentationMethods();
                        $model_methods[$property->id]->csMethod = $csMethod;
                        $model_methods[$property->id]->property = $property;
                        $model_methods[$property->id]->service = $service;
                    }
                }           
            }
            return (isset($model_methods)) ? $model_methods : null;
        }
        return null;
    }

    public function loadPresentationMethodsUpdate($model_methods)
    {
        if($model_methods) {
            foreach($model_methods as $model_method){
                $property = $model_method->method->property;
                $model_method->csMethod = $model_method->method;
                $model_method->property = $property;
                $model_method->service = $this->pService;
            }
            return $model_methods;
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
