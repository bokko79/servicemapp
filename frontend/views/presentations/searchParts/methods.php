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

$message = Yii::t('app', '{whatkind} {action} vršite?', ['whatkind'=>$whatkind, 'action'=>$action->tName]);
?>
<div class="wrapper headline search" style="">
    <label class="head">
    	<i class="fa fa-play-circle fa-lg"></i>&nbsp;
        <?= Yii::t('app', '{whatkind} {action} vršite?', ['whatkind'=>$whatkind, 'action'=>$action->tName]) ?>
    </label>
    <i class="fa fa-chevron-right chevron"></i>
</div>
<div class="wrapper notshown body fadeIn animated" style="border-top:none;">
<?= $this->render('../_hint.php', ['message'=>$message]) ?>
<?php foreach($model_methods as $index=>$model_method) {
		$method = $model_method->csMethod;
		$property = $model_method->property;	
		echo $this->render('method/'.$property->formType($service->service_object).'.php', ['form'=>$form, 'index'=>$index, 'model_method'=>$model_method, 'method'=>$method, 'property'=>$property, 'service'=>$service, 'input'=>Yii::$app->request->get('PresentationMethods')]);
		echo Html::activeHiddenInput($model_method, '['.$index.']method_id', ['value'=>$method->id]);
	} ?>
</div>