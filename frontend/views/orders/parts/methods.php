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

$message = Yii::t('app', '{whatkind} {action} Vam treba?', ['whatkind'=>$whatkind, 'action'=>$action->tName]);
?>
<div class="wrapper headline" style="">
    <label class="head">
        <span class="badge"><?= $model->noMethods ?></span>&nbsp;
        <?= Yii::t('app', '{whatkind} {action} Vam treba?', ['whatkind'=>$whatkind, 'action'=>$action->tName]) ?>
    </label>
    <?= ' <span class="optional">(opciono)</span>' ?>
    <i class="fa fa-chevron-right chevron"></i>
</div>

<div class="wrapper notshown body fadeIn animated" style="border-top:none;">
<?= $this->render('../_hint.php', ['message'=>$message]) ?>
<?php foreach($model_methods as $model_method) {
		$method = $model_method->serviceMethod;
		$property = $model_method->property;
		echo $this->render('method/'.$property->formType.'.php', ['form'=>$form, 'key'=>$property->id, 'model_method'=>$model_method, 'method'=>$method, 'property'=>$property, 'service'=>$service]);
	} ?>    
</div>