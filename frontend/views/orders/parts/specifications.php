<?php

use yii\helpers\Html;
use kartik\widgets\ActiveForm;
use kartik\widgets\ActiveField;
use yii\helpers\ArrayHelper;

$specific_properties = [];

$object = $service->object;
switch ($object->t[0]->name_gender) {
    case 'm':
        $whatkind = 'kakav';
        $your = 'Vaš';
        break;
    case 'f':
        $whatkind = 'kakva';
        $your = 'Vašu';
        break;  
    default:
        $whatkind = 'kakvo';
        $your = 'Vaše';
        break;
}
?>
<div class="wrapper headline" style="">
    <label class="head">
        <span class="badge">3</span>&nbsp;

        <?= ($service->service_object!=1) ? Yii::t('app', 'Opišite ukratko {your} {object}...', ['your'=>$your, 'object'=>$object->tName]) :
        Yii::t('app', 'Opišite ukratko {whatkind} {object} zahtevate...', ['whatkind'=>$whatkind, 'object'=>$object->tName]) ?>
    </label>
    <i class="fa fa-chevron-right chevron"></i>
</div>

<div class="wrapper body fadeIn animated" style="border-top:none;">

<?php // specifikacije osnovnog predmeta usluge
	/*foreach($serviceSpecs as $key=>$serviceSpec) {
		$specification = $serviceSpec->spec;
		if($specification) {
			$property = $specification->property;
			if($property) {				
				$model_spec = new \frontend\models\CartServiceObjectSpecification();
				$model_spec->serviceSpec = $specification;
				echo $this->render('specification/'.$property->formType.'.php', ['form'=>$form, 'key'=>$property->id, 'model_spec'=>$model_spec, 'specification'=>$specification, 'property'=>$property, 'serviceSpec'=>$serviceSpec, 'service'=>$service, 'object_type'=>$object_type]);
				$specific_properties[] = $property->id;
			}
		}			
	}*/ ?>

<?php // specifikacije izabranih modela (vrsta) predmeta usluge
	/*foreach($object_models as $key=>$object_model) {
		$object = \frontend\models\CsObjects::findOne($object_model);
		if ($object) {
			$specifications = $object->specs;
			if ($specifications) {
				foreach($specifications as $key=>$specification) {
					$property = $specification->property;					
					$model_spec = new \frontend\models\CartServiceObjectSpecification();
					$model_spec->serviceSpec = $specification;		
					if($property) {
						if(!in_array($property->id, $specific_properties)){
							echo $this->render('specification/'.$property->formType.'.php', ['form'=>$form, 'key'=>$property->id, 'model_spec'=>$model_spec, 'specification'=>$specification, 'property'=>$property, 'serviceSpec'=>$serviceSpec, 'service'=>$service, 'object_type'=>$object_type]);
							$specific_properties[] = $property->id;
						}
					}									
				}
			}			
		}		
	}*/ 

	foreach($model_specs as $model_spec) {
		$specification = $model_spec->specification;
		$property = $model_spec->property;
		echo $this->render('specification/'.$property->formType.'.php', ['form'=>$form, 'key'=>$property->id, 'model_spec'=>$model_spec, 'specification'=>$specification, 'property'=>$property, 'service'=>$service, 'object_type'=>$object_type]);
	} ?>
    
</div>