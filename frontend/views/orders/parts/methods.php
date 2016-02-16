<?php

use yii\helpers\Html;
use kartik\widgets\ActiveForm;
use kartik\widgets\ActiveField;
use yii\helpers\ArrayHelper;

$action = $service->action;
switch ($action->t[0]->name_gender) {
	case 'm':
		$whatkind = 'Kakav';
		break;
	case 'f':
		$whatkind = 'Kakva';
		break;	
	default:
		$whatkind = 'Kakvo';
		break;
}
?>
<div class="wrapper headline" style="">
    <label class="head">
        <span class="badge">2</span>&nbsp;
        <?php echo Yii::t('app', '{whatkind} {action} Vam treba?', ['whatkind'=>$whatkind, 'action'=>$action->tName]); ?>
    </label>
    <i class="fa fa-chevron-right chevron"></i>
</div>

<div class="wrapper body fadeIn animated" style="border-top:none;">

<?php /*foreach($serviceMethods as $key=>$serviceMethod) {
		$method = $serviceMethod->method;			
		$property = $serviceMethod->method->property;					
		$model_method = new \frontend\models\CartServiceActionMethod();
		$model_method->serviceMethod = $serviceMethod;

		echo $this->render('method/'.$property->formType.'.php', ['form'=>$form, 'key'=>$key, 'model_method'=>$model_method, 'method'=>$method, 'property'=>$property, 'serviceMethod'=>$serviceMethod, 'service'=>$service]);
	} */
	foreach($model_methods as $model_method) {
		$method = $model_method->serviceMethod;
		$property = $model_method->property;
		echo $this->render('method/'.$property->formType.'.php', ['form'=>$form, 'key'=>$property->id, 'model_method'=>$model_method, 'method'=>$method, 'property'=>$property, 'service'=>$service]);
	} ?>
    
</div>