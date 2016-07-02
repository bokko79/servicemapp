<?php

namespace common\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\Presentations;

/**
 * PresentationsSearch represents the model behind the search form about `common\models\Presentations`.
 */
class PresentationsSearch extends PresentationData
{
    public $quantity;
    public $quantity_operator;
    public $consumer;
    public $consumer_operator;
    public $availability;
    public $industry;
    public $provider;
    public $service;
    public $service_id;
    public $object;
    public $object_models = [];

    public $budget;
    public $budget_operator;

    public $methods = [];

    public $specs = [];

    public $issues = [];

    public $timetable;
    public $location;
    public $coverage;
    public $coverage_within;



    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'activity_id', 'offer_id', 'provider_service_id', 'quantity', 'consumer'], 'integer'],
            [['methods', 'specs', 'issues', 'timetable', 'budget_operator', 'consumer_operator', 'quantity_operator', 'object_models'], 'safe'],
            [['coverage', 'coverage_within'], 'safe'],
            [['title'], 'string'],
            [['budget', 'calculated_Price'], 'number', 'min'=>0],
        ];
    } 

    /**
     * @inheritdoc
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    /**
     * @inheritdoc
     */
    public function queryQuantity()
    {
        if($this->quantity_operator and $this->quantity){
            switch ($this->quantity_operator) {
                case 'approx':
                    return ['AND', ['OR', ['<=', 'presentations.quantity_min', $this->quantity*1.2], 'presentations.quantity_min IS NULL'], ['OR', ['>=', 'presentations.quantity_max', $this->quantity*0.8], 'presentations.quantity_max IS NULL']];
                    break;               
                default:
                    return ['AND', ['OR', ['<=', 'presentations.quantity_min', $this->quantity], 'presentations.quantity_min IS NULL'], ['OR', ['>=', 'presentations.quantity_max', $this->quantity], 'presentations.quantity_max IS NULL']];
                    break;
            }
        }
        return [];
    }

    /**
     * @inheritdoc
     */
    public function queryConsumers()
    {
        if($this->consumer_operator and $this->consumer){
            switch ($this->consumer_operator) {
                case 'approx':
                    return ['AND', ['OR', ['<=', 'presentations.consumer_min', $this->consumer*1.2], 'presentations.consumer_min IS NULL'], ['OR', ['>=', 'presentations.consumer_max', $this->consumer*0.8], 'presentations.consumer_max IS NULL']];
                    break;               
                default:
                    return ['AND', ['OR', ['<=', 'presentations.consumer_min', $this->consumer], 'presentations.consumer_min IS NULL'], ['OR', ['>=', 'presentations.consumer_max', $this->consumer], 'presentations.consumer_max IS NULL']];
                    break;
            }
        }
        return [];
    }

    /**
     * @inheritdoc
     */
    public function queryPrice()
    {
        if($this->budget!='' and $this->budget!=null){
           if($this->quantity!=null or $this->quantity!=''){
                return ['OR', ['OR', ['AND', 'presentations.price <= '.$this->budget.'*100/(100-presentations.qtyMax_percent)', 'presentations.qtyMax<'.$this->quantity], 'presentations.price <= '.$this->budget], ['AND', 'presentations.qtyMin_price <='.$this->budget, 'presentations.qtyMin>'.$this->quantity]];
            }
            if($this->consumer!=null or $this->consumer!=''){
                return ['OR', ['OR', ['AND', 'presentations.price <= '.$this->budget.'*100/(100-presentations.consumerMax_percent)', 'presentations.consumerMax<'.$this->consumer], 'presentations.price <= '.$this->budget], ['AND', 'presentations.consumerMin_price <='.$this->budget, 'presentations.consumerMin>'.$this->consumer]];
            } 
        }
            
        return [];
    }

    /**
     * @inheritdoc
     */
    public function querySpecs()
    {
        if($presSpecs = Yii::$app->request->get('PresentationSpecs') and $service = $this->service){
            //echo '<pre>';
            //print_r($presSpecs); die();
            $arrSpec = '';
            foreach ($presSpecs as $key => $presSpec) {
                if(is_array($presSpec) and ((isset($presSpec['value']) and $presSpec['value']!='') or (isset($presSpec['spec_models']) and $presSpec['spec_models']!=''))){
                    $property = \common\models\CsProperties::findOne($key);
                    $arrSpec .= '(presentation_object_properties.spec_id='.$presSpec['spec_id'].' AND ';
                    if($property->type==1){
                        if($presSpec['value']!=''){
                            if($service->service_object==1 or $service->service_object==3 or $service->service_object==5){
                                // ako je provajderov predmet, onda je range
                                $arrSpec .= '(presentation_object_properties.value>'.$presSpec['value'].' OR presentation_object_properties.value IS NULL)';
                            } else {
                                $arrSpec .= '(presentation_object_properties.value<'.$presSpec['value'].' AND presentation_object_properties.value>'.$presSpec['value'].')';
                            }
                        } else {
                            $arrSpec .= '1=1';
                        }
                    }
                    if($property->type==2 or $property->type==21 or $property->type==3){
                        if($presSpec['spec_models']!=''){
                            if($service->service_object==1 or $service->service_object==3 or $service->service_object==5){
                                // multi od multi 
                                $arrSpecPref = '(';                         
                                foreach($presSpec['spec_models'] as $spc_mdl){
                                    $arrSpecPref .= 'presentation_object_property_values.property_value_id='.$spc_mdl.' OR ';
                                }                            
                                $arrSpecPref = substr($arrSpecPref, 0, -4);
                                $arrSpecPref .= ')';
                                $arrSpec .= $arrSpecPref;     
                            } else {
                                // radio = ako je vrednost (jedna) među spec_modelima (više)
                                $arrSpec .= 'presentation_object_property_values.property_value_id='.$presSpec['spec_models'][0];
                            }
                        } else {
                            $arrSpec .= '1=1';
                        }
                    }
                    if($property->type==4 or $property->type==41){
                        if($presSpec['spec_models']!=''){
                            $arrSpecPref = '(';                         
                            foreach($presSpec['spec_models'] as $spc_mdl){
                                $arrSpecPref .= 'presentation_object_property_values.property_value_id='.$spc_mdl.' OR ';
                            }                            
                            $arrSpecPref = substr($arrSpecPref, 0, -4);
                            $arrSpecPref .= ')';
                            $arrSpec .= $arrSpecPref;
                        }  else {
                            $arrSpec .= '1=1';
                        }
                    }
                    if($property->type==5){
                        $arrSpec .= 'presentation_object_properties.value='.$presSpec['value'];                        
                    }
                    $arrSpec .= ') OR ';
                }                    
            }
            return $arrSpec!='' ? substr($arrSpec, 0, -4) : [];            
        }
        return [];
    }

    /**
     * @inheritdoc
     */
    public function queryMethods()
    {
        if($presMethods = Yii::$app->request->get('PresentationMethods') and $service = $this->service){
            //echo '<pre>';
            //print_r($presSpecs); die();
            $arrMeth = '';
            foreach ($presMethods as $key => $presMethod) {
                if(is_array($presMethod) and ((isset($presMethod['value']) and $presMethod['value']!='') or (isset($presMethod['method_models']) and $presMethod['method_models']!=''))){
                    $property = \common\models\CsProperties::findOne($key);
                    $arrMeth .= '(presentation_action_properties.action_property_id='.$presMethod['method_id'].' AND ';
                    if($property->type==1 or $property->type==5){
                        if($presMethod['value']!=''){
                            // ako je provajderov predmet, onda je range
                            $arrMeth .= '(presentation_action_properties.value>'.$presMethod['value'].' OR presentation_action_properties.value IS NULL)';                            
                        } else {
                            $arrMeth .= '1=1';
                        }
                    }
                    if($property->type==2 or $property->type==21 or $property->type==3 or $property->type==4 or $property->type==41){
                        if(isset($presMethod['method_models']) and $presMethod['method_models']!=''){                            
                            $arrMethPref = '(';                         
                            foreach($presMethod['method_models'] as $mth_mdl){
                                $arrMethPref .= 'presentation_action_property_values.property_value_id='.$mth_mdl.' OR ';
                            }                            
                            $arrMethPref = substr($arrMethPref, 0, -4);
                            $arrMethPref .= ')';
                            $arrMeth .= $arrMethPref;    
                            
                        } else {
                            $arrMeth .= '1=1';
                        }
                    }
                    $arrMeth .= ') OR ';
                }                    
            }
            return $arrMeth!='' ? substr($arrMeth, 0, -4) : [];            
        }
        return [];
    }

    /**
     * @inheritdoc
     */
    public function queryLocations()
    {
        if($location = Yii::$app->request->get('Locations') and $this->coverage!='' and (isset($location['lat']) and $location['lat']!='') and (isset($location['lng']) and $location['lng']!='')){
            $lat = $location['lat'];
            $lng = $location['lng'];
            $city = $location['city']!='' ? $location['city'] : null;
            $country = $location['country']!='' ? $location['country'] : null;
            $coverage = $this->coverage;
            $within = $this->coverage_within;
            switch ($coverage) {
                case 6:
                    return [];
                    break;

                case 4:
                    return 'locations.country="'.$country.'" OR presentations.coverage=6 OR provider.coverage=6';
                    break;

                case 2:
                    return 'locations.city="'.$city.'" OR presentations.coverage=6 OR provider.coverage=6 OR (provider.coverage=4 AND locations.country="'.$country.'")';
                    break;
                
                default:
                    return '(locations.lat
                             BETWEEN '.$lat.'  - (('.$within.'+ presentations.coverage_within) / 111.045)
                                 AND '.$lat.'  + (('.$within.'+ presentations.coverage_within) / 111.045)
                            AND locations.lng
                             BETWEEN '.$lng.' - (('.$within.'+ presentations.coverage_within) / (111.045 * COS(RADIANS('.$lng.'))))
                                 AND '.$lng.' + (('.$within.'+ presentations.coverage_within) / (111.045 * COS(RADIANS('.$lng.'))))) OR presentations.coverage=6 OR provider.coverage=6'; // calculation
                    break;
            }
            //print_r($lng); die();                  
        }
        return [];
    }

    /**
     * @inheritdoc
     */
    public function queryObjectModels()
    {
        if($this->object_models){
            $arr = '';
            for($i=0; $i<count($this->object_models); $i++){
                $arr .= 'presentation_object_models.object_model_id='.$this->object_models[$i];
                if($i<(count($this->object_models)-1)){
                    $arr .= ' OR ';
                }
            }
            return $arr;
        }
        return [];
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $query = Presentations::find();

        // add conditions that should always apply here
        $query->joinWith(['objectModels', 'presentationObjectPropertyValues', 'presentationActionPropertyValues', 'location', 'provider']);

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'activity_id' => $this->activity_id,
            'offer_id' => $this->offer_id,
            'provider_service_id' => $this->provider_service_id,
        ]);

        $query->andFilterWhere(['like', 'title', $this->title]);
        $query->andFilterWhere($this->queryQuantity());
        $query->andFilterWhere($this->queryConsumers());
        $query->andFilterWhere($this->queryPrice());
        $query->andWhere($this->queryObjectModels());

        //$query->andWhere($this->querySpecs());
        //$query->andWhere($this->queryMethods());
        //$query->andWhere($this->queryLocations());

        $query->groupBy('presentations.id');

        return $dataProvider;
    }
}
