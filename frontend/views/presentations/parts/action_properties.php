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
<?= $this->render('actionProperty/_similar_action_properties.php', ['form'=>$form, 'model'=>$model, 'user'=>$user, 'service'=>$service]) ?>
<?php foreach($model_action_properties as $index=>$model_action_property) {
		$actionProperty = $model_action_property->theActionProperty;
		$property = $model_action_property->property;	
		echo $this->render('actionProperty/'.$property->formTypePresentation($service->object_ownership).'.php', ['form'=>$form, 'index'=>$index, 'model_action_property'=>$model_action_property, 'actionProperty'=>$actionProperty, 'property'=>$property, 'service'=>$service]);
		//echo Html::activeHiddenInput($model_action_property, '['.$index.']method_id', ['value'=>$actionProperty->id]);
	} ?>
<?php if($user and $user->provider && $user->provider->presWithSameAction($service->action_id)!=null and Yii::$app->controller->action->id=='create'){ ?>
    </div>
<?php } ?>
<?= $this->render('actionProperty/_duration.php', ['form'=>$form, 'model'=>$model, 'service'=>$service]) ?>
<?= $this->render('_submitButton.php') ?>
</div>