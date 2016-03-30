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
<div class="wrapper headline" style="" id="action">
    <label class="head">
        <span class="badge"><?= $model->noMethods ?></span>&nbsp;
        <?= Yii::t('app', '{whatkind} {action} vršite?', ['whatkind'=>$whatkind, 'action'=>$action->tName]) ?>
    </label>
    <?= ' <span class="optional">(opciono)</span>' ?>
    <i class="fa fa-chevron-down chevron"></i>
</div>
<div class="wrapper body fadeIn animated" style="border-top:none;" id="sections03">
<?= $this->render('../_hint.php', ['message'=>$message]) ?>
<?= $this->render('method/_similar_methods.php', ['form'=>$form, 'model'=>$model, 'user'=>$user, 'service'=>$service]) ?>
<?php foreach($model_methods as $index=>$model_method) {
		$method = $model_method->csMethod;
		$property = $model_method->property;	
		echo $this->render('method/'.$property->formTypePresentation($service->service_object).'.php', ['form'=>$form, 'index'=>$index, 'model_method'=>$model_method, 'method'=>$method, 'property'=>$property, 'service'=>$service]);
		echo Html::activeHiddenInput($model_method, '['.$index.']method_id', ['value'=>$method->id]);
	} ?>
<?php if($user && $user->provider->presWithSameAction($service->action_id)!=null and Yii::$app->controller->action->id=='create'){ ?>
    </div>
<?php } ?>
<?= $this->render('method/_duration.php', ['form'=>$form, 'model'=>$model, 'service'=>$service]) ?>
<?= $this->render('_submitButton.php') ?>
</div>